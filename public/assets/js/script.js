var backdrop = document.getElementById('backdrop');

function showBookDialog(title, description, author, category, img) {

    document.getElementById('dialog-title').innerText = title;
    document.getElementById('dialog-description').innerText = description;
    document.getElementById('dialog-author').innerText = author;
    document.getElementById('dialog-category').innerText = category;
    document.getElementById('dialog-image').src = img;
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
        // Hide all items
        carouselItems.forEach(item => {
            item.style.transform = `translateX(-${index * 100}%)`;
        });
    }

    // Show initial item
    showItem(currentIndex);

    // Next button click
    document.querySelector('.next-btn').addEventListener('click', function () {
        currentIndex = (currentIndex + 1) % totalItems;
        showItem(currentIndex);
    });

    // Previous button click
    document.querySelector('.prev-btn').addEventListener('click', function () {
        currentIndex = (currentIndex - 1 + totalItems) % totalItems;
        showItem(currentIndex);
    });
});
