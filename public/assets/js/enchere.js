// assets/js/enchere.js

// Function to handle sorting and updating the 

function sortdata() {
    const sortBy = document.getElementById('sort-data').value;
    const auctionsContainer = document.getElementById('auctions');
    const auctions = Array.from(auctionsContainer.children);
    
    if (sortBy === 'lth') {
        auctions.sort((a, b) => {
            const priceA = parseFloat(a.querySelector('.montant-initial').innerText);
            const priceB = parseFloat(b.querySelector('.montant-initial').innerText);
            return priceA - priceB;
        });
    } else if (sortBy === 'htl') {
        auctions.sort((a, b) => {
            const priceA = parseFloat(a.querySelector('.montant-initial').innerText);
            const priceB = parseFloat(b.querySelector('.montant-initial').innerText);
            return priceB - priceA;
        });
    }
    
    auctionsContainer.innerHTML = '';
    auctions.forEach(auction => auctionsContainer.appendChild(auction));
}

// Function to handle filtering by montant initial
document.getElementById('filter-form').addEventListener('submit', function (event) {
    event.preventDefault();
    const formData = new FormData(this);
    const queryString = new URLSearchParams(formData).toString();
    
    fetch(`/enchere/?${queryString}`)
        .then(response => response.text())
        .then(html => {
            document.getElementById('auctions').innerHTML = html;
        });
});

// Function to handle searching by name
document.getElementById('search-form').addEventListener('submit', function (event) {
    event.preventDefault();
    const formData = new FormData(this);
    const queryString = new URLSearchParams(formData).toString();
    
    fetch(`/enchere/?${queryString}`)
        .then(response => response.text())
        .then(html => {
            document.getElementById('auctions').innerHTML = html;
        });
});
