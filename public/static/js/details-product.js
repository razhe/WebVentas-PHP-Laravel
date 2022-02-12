//Imagenes preview
const imgs = document.querySelectorAll('.img-select a'),
      imgBtns = [...imgs];
let imgId = 1;

imgBtns.forEach((imgItem) => {
    imgItem.addEventListener('click', (event) => {
        event.preventDefault();
        imgId = imgItem.dataset.id;
        slideImage();
    });
});

function slideImage(){
    const displayWidth = document.querySelector('.img-showcase img:first-child').clientWidth;

    document.querySelector('.img-showcase').style.transform = `translateX(${- (imgId - 1) * displayWidth}px)`;
}

window.addEventListener('resize', slideImage);
//Imagenes preview
//Tabs
let tabs = document.querySelectorAll('.tabs__toggle'),
    contents = document.querySelectorAll('.tabs__content');

tabs.forEach((tab, index) =>{
    tab.addEventListener('click', (event)=>{
        contents.forEach((content)=>{
            content.classList.remove('active');
        });
        tabs.forEach((tab)=>{
            tab.classList.remove('active');
        });
        contents[index].classList.add('active');
        tabs[index].classList.add('active');
    });
});
//Tabs