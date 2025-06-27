document.addEventListener("DOMContentLoaded", () => {
    const products = [
        {
            id: 0,
            image: 'https://starbucksstatic.cognizantorderserv.com/Items/Small/webP/104997.webp',
            title: 'Cold Brew Black',
            price: 299
        },
        {
            id: 1,
            image: 'https://starbucksstatic.cognizantorderserv.com/Items/Small/webP/100447.webp',
            title: 'Signature Chocolate',
            price: 309
        },
        {
            id: 2,
            image: 'https://starbucksstatic.cognizantorderserv.com/Items/Small/webP/112573.webp',
            title: 'Vanilla Milkshake',
            price: 378
        },
        {
            id: 3,
            image: 'https://starbucksstatic.cognizantorderserv.com/Items/Small/109617_1.png',
            title: '250G Diwali Blend',
            price: 110
        },
        {
            id: 4,
            image: 'https://starbucksstatic.cognizantorderserv.com/Items/Small/116569.png',
            title: 'Pink Drink',
            price: 367
        },
        {
            id: 5,
            image: 'https://starbucksstatic.cognizantorderserv.com/Items/Small/100433.jpg',
            title: 'Tall Java Chip',
            price: 290
        },
    ];

    const searchInput = document.getElementById('search');
    const searchButton = document.getElementById('searchButton');

    const filterAndDisplayItems = () => {
        const searchData = searchInput.value.toLowerCase();
        const filteredData = products.filter((item) =>
            item.title.toLowerCase().includes(searchData)
        );
        displayItems(filteredData);
    };

    searchInput.addEventListener('input', () => {
        if (searchInput.value === "") {
            displayItems(products); 
        }
    });

    searchButton.addEventListener('click', (event) => {
        event.preventDefault();
        filterAndDisplayItems();
    });

    const displayItems = (items) => {
        let rootElement = document.getElementById('root1');
    
        if (!rootElement) {
            console.error("Element with ID 'root1' not found!");
            return;
        }
    
        rootElement.innerHTML = items.length > 0
            ? items.map((item) => {
                return `
                    <form method="POST" action="manage_cart.php">
                        <div class='box'>
                            <div class='img-box'>
                                <img class='img' src="${item.image}" alt="${item.title}">
                            </div>
                            <div class='bottom'>
                                <h2>${item.title}</h2>
                                <h4>₹${item.price}.00</h4>
                                <input type="hidden" name="Item_Name" value="${item.title}">
                                <input type="hidden" name="Price" value="${item.price}">
                                <button class='btn3 btn-success' type="submit" name="submit">Add Item</button>
                            </div>
                        </div>
                    </form>
                `;
            }).join('')
            : "<p class='text-danger text-center p'>No products found</p>";
    };
    

    displayItems(products);
});
