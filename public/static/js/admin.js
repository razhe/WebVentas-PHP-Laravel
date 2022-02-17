//chart.js
const charts = document.querySelectorAll(".chart");

charts.forEach(function (chart) {
  var ctx = chart.getContext("2d");
  var myChart = new Chart(ctx, {
    type: "bar",
    data: {
      labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
      datasets: [
        {
          label: "# of Votes",
          data: [12, 19, 3, 5, 2, 3],
          backgroundColor: [
            "rgba(255, 99, 132, 0.2)",
            "rgba(54, 162, 235, 0.2)",
            "rgba(255, 206, 86, 0.2)",
            "rgba(75, 192, 192, 0.2)",
            "rgba(153, 102, 255, 0.2)",
            "rgba(255, 159, 64, 0.2)",
          ],
          borderColor: [
            "rgba(255, 99, 132, 1)",
            "rgba(54, 162, 235, 1)",
            "rgba(255, 206, 86, 1)",
            "rgba(75, 192, 192, 1)",
            "rgba(153, 102, 255, 1)",
            "rgba(255, 159, 64, 1)",
          ],
          borderWidth: 1,
        },
      ],
    },
    options: {
      scales: {
        y: {
          beginAtZero: true,
        },
      },
    },
  });
});


//traer las marcas al frontend
function traerMarcas() {
  $.ajax({
    url:'brands/opts',
    method:'get',
    data:'',
    success:function(data){
      let html = '<option selected disabled>Marcas...</option>';
      for (let i = 0; i < data.brands.length; i++) {
        html += 
        `
        <option value="${data.brands[i].id}">${data.brands[i].name}</option>
        `;
        data.brands[i];
      }
      document.getElementById('select-brands-add').innerHTML = html;
      document.getElementById('select-brands-edit').innerHTML = html;
    }
  });
}

//traer las categorias al frontend
function traerCategorias() {
  $.ajax({
    url:'categories/opts',
    method:'get',
    data:'',
    success:function(data){
      let html = '<option selected disabled>Categoría...</option>';
      for (let i = 0; i < data.categories.length; i++) {
        html += 
        `
        <option value="${data.categories[i].id}">${data.categories[i].name}</option>
        `;
        data.categories[i];
      }
      document.getElementById('select-category-add').innerHTML = html;
      document.getElementById('select-category-edit').innerHTML = html;
    }
  });
}

function traerSubcategorias() {
  $.ajax({
    url:'subcategories/get',
    method:'get',
    data:'',
    success:function(data){      
      let html = '<option selected disabled>Subcategoría...</option>';
      for (let i = 0; i < data.subcategories.length; i++) {
        html += 
        `
        <option value="${data.subcategories[i].id}">${data.subcategories[i].name}</option>
        `;
        data.subcategories[i];
      }
      document.getElementById('select-subcategory-add').innerHTML = html;
      document.getElementById('select-subcategory-edit').innerHTML = html;
      
    }
  });
}
//traer valores de categoria al frontend
function editarCategoria(id) {
  $.ajax({
    url:'categories/edit/'+id,
    method:'get',
    data:'',
    success:function(data){
      $('#id-categoria-editar').val(data.id);
      $('#nombre-categoria-editar').val(data.name);
      $('#estado-categoria-editar').val(data.status);
      
    }
  });
}
//traer valores de usuario al frontend
function EditarUsuario(id) {
  $.ajax({
    url:'users/edit/'+id,
    method:'get',
    data:'',
    success:function(data){
      $('#id-editar-usuario').val(data.id);
      $('#nombre-editar-usuario').val(data.name);
      $('#apellido-editar-usuario').val(data.last_name);
      $('#telefono-editar-usuario').val(data.phone);
      $('#correo-editar-usuario').val(data.email);
      $('#estado-editar-usuario').val(data.status);
      $('#rol-editar-usuario').val(data.id_tasks);
    }
  });
}
//traer valores de subcategoria al frontend
function editarSubCategoria(id) {
  $.ajax({
    url:'subcategories/edit/'+id,
    method:'get',
    data:'',
    success:function(data){
      $('#id-subcategoria-editar').val(data.id);
      $('#nombre-subcategoria-editar').val(data.name);
      $('#estado-subcategoria-editar').val(data.status);
      $('#select-category-edit').val(data.id_category);
    }
  });
}
function EditarProducto(id) {
  $.ajax({
    url:'products/edit/'+id,
    method:'get',
    data:'',
    success:function(data){
      console.log(data);
      $('#id-producto-editar').val(data.id);
      $('#nombre-producto-editar').val(data.name);
      $('#precio-producto-editar').val(data.price);
      $('#descuento-producto-editar').val(data.discount);
      CKEDITOR.instances["area-description-edit"].setData(data.description);
      //$('#area-description-edit').val(data.description);
      $('#stock-producto-editar').val(data.stock);
      $('#sku-producto-editar').val(data.sku);
      $('#select-brands-edit').val(data.id_brand);
      $('#select-subcategory-edit').val(data.id_subcategory);
      $('#estado-producto-editar').val(data.status);
    }
  });
}
//Traer valores de marca al frontend
function EditarMarca(id){
  $.ajax({
    url:'brands/edit/'+id,
    method:'get',
    data:'',
    success:function(data){
      $('#id-marca-editar').val(data.brand.id);
      $('#nombre-marca-editar').val(data.brand.name);
      $('#estado-marca-editar').val(data.brand.status);
    }
  });
}
//filtro de categoria a subcategoria en producto
const selectCategoryAdd = document.getElementById('select-category-add');
const selectCategoryEdit = document.getElementById('select-category-edit');

function filtrarSubcategoriasAdd(){
  selectCategoryAdd.addEventListener('change', (event) => {
    let id = event.target.value
    $.ajax({
      url:'subcategories/find/'+id,
      method:'get',
      data:'',
      success:function(data){
        let html = ''
        let selectSubcategoryAdd = document.getElementById('select-subcategory-add');     
        html = '<option selected disabled>Ya puede seleccionar...</option>';
        for (let i = 0; i < data.subcategories.length; i++) {
          html += `<option value="${data.subcategories[i].id}">${data.subcategories[i].name}</option>`;
          data.subcategories[i];
        }
        selectSubcategoryAdd.innerHTML = html;
      }
    });
    
  });
}

function filtrarSubcategoriasEdit(){
  selectCategoryEdit.addEventListener('change', (event) => {
    let id = event.target.value
    $.ajax({
      url:'subcategories/find/'+id,
      method:'get',
      data:'',
      success:function(data){
        let html = ''
        let selectSubcategoryEdit = document.getElementById('select-subcategory-edit');   
        html = '<option selected disabled>Ya puede seleccionar...</option>';
        for (let i = 0; i < data.subcategories.length; i++) {
          html += `<option value="${data.subcategories[i].id}">${data.subcategories[i].name}</option>`;
          data.subcategories[i];
        }
        selectSubcategoryEdit.innerHTML = html;
      }
    });
    
  });
}



