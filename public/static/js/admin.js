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

//CKEDITOR
var base = location.protocol+'//'+location.host;

function editor_init(field){
//  CKEDITOR.plugins.addExternal( 'codesnippet', base+'/static/libs/ckeditor/codesnippet/', 'plugin.js' );
  CKEDITOR.replace(field,{
    toolbar: [
      { name: 'clipboard', items: ['Cut', 'Copy', 'Paste', 'PasteText', '-', 'Undo', 'Redo'] },
      { name: 'basicstyles', items: [ 'Bold', 'Italic', 'BulletedList', 'Strike', 'Image', 'Link', 'UnLink', 'Blockquote' ] },
      { name: 'document', items: ['CodeSnippet', 'EmojiPanel', 'Preview', 'Souce'] }
    ]
  });
};

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