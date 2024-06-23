var backdrop = document.getElementById('backdrop');

function showBookDialog(title, description, author, category, img) {

    console.log(img);

    document.getElementById('dialog-title').innerText = title;
    document.getElementById('dialog-description').innerText = description;
    document.getElementById('dialog-author').innerText = author;
    document.getElementById('dialog-category').innerText = category;

    var imgElement = document.getElementById('dialog-image');
    imgElement.src = img;

    imgElement.onerror = function () {
        console.log('Image failed to load.');
      
        imgElement.src = 'https://placehold.co/600x400';
    };

    console.log(document.getElementById('dialog-image').src);

    var dialog = document.getElementById('dialog');
    if (!dialog.showModal) {
        dialogPolyfill.registerDialog(dialog);


    }
    dialog.showModal();

    backdrop.style.display = "block";
    document.body.style.overflow = 'hidden';
}

function closeDialog() {
    var dialog = document.getElementById('dialog');
    document.body.style.overflow = '';
    backdrop.style.display = "none";
    dialog.close();
}

document.body.addEventListener('keydown', function (e) {
    if (e.key == "Escape") {
        var dialog = document.getElementById('dialog');
        document.body.style.overflow = '';
        backdrop.style.display = "none";
        dialog.close();
    }
});

document.addEventListener('DOMContentLoaded', function () {
    const carouselItems = document.querySelectorAll('.carousel-item');
    const totalItems = carouselItems.length;
    let currentIndex = 0;

    function showItem(index) {
 
        carouselItems.forEach(item => {
            item.style.transform = `translateX(-${index * 100}%)`;
        });
    }


    showItem(currentIndex);

    document.querySelector('.next-btn').addEventListener('click', function () {
        currentIndex = (currentIndex + 1) % totalItems;
        showItem(currentIndex);
    });


    document.querySelector('.prev-btn').addEventListener('click', function () {
        currentIndex = (currentIndex - 1 + totalItems) % totalItems;
        showItem(currentIndex);
    });
});
