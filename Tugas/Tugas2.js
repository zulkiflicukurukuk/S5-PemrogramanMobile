let cart = [];
let total = 0;

function addToCart(title, price, productId) {
    cart.push({ title, price, productId });
    total += price;
    updateCart();
}

function updateCart() {
    const cartItems = document.getElementById('cartItems');
    const totalPrice = document.getElementById('totalPrice');
    cartItems.innerHTML = '';
    cart.forEach(item => {
        const li = document.createElement('li');
        li.textContent = `${item.title} - $${item.price.toFixed(2)}`;
        cartItems.appendChild(li);
    });
    totalPrice.textContent = `Total: $${total.toFixed(2)}`;
}

function filterCDs() {
    const input = document.getElementById('searchBar').value.toLowerCase();
    const cdCards = document.getElementsByClassName('cd-card');
    for (let i = 0; i < cdCards.length; i++) {
        const title = cdCards[i].getElementsByClassName('cd-title')[0].innerText.toLowerCase();
        cdCards[i].style.display = title.includes(input) ? '' : 'none';
    }
}

// Event listener untuk tombol "Add to Cart"
document.querySelectorAll('.add-to-cart').forEach(button => {
    button.addEventListener('click', () => {
        const title = button.getAttribute('data-title');
        const price = parseFloat(button.getAttribute('data-price'));
        const productId = button.getAttribute('data-id');
        addToCart(title, price, productId);
    });
});

// Menambahkan event listener untuk search bar agar filter berjalan saat pengguna mengetik
document.getElementById('searchBar').addEventListener('keyup', filterCDs);
