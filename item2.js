document.addEventListener("DOMContentLoaded", () => {
    const products = [
        {
            id: 0,
            image: 'https://starbucksstatic.cognizantorderserv.com/Items/Small/105468.jpg',
            title: 'Cold Drink',
            per:'Our signature rich in flavour espresso blended with delicate...',
            price: 299,
        },
        {
            id: 1,
            image: 'https://starbucksstatic.cognizantorderserv.com/Items/Small/100501.jpg',
            title: 'Java Chip Frappuccino',
            per: ' Mocha sauce and Frappuccino® chips blended with with Frappu...',
            price:  388,
        },
        {
            id: 2,
            image: 'https://starbucksstatic.cognizantorderserv.com/Items/Small/100433.jpg',
            title: 'Cold Coffee',
            per:'  Captivating, cosy, coffee. Gift your loved ones this Starbucks Gift Card.',
            price:  278,
        },
        {
            id: 3,
            image: 'https://starbucksstatic.cognizantorderserv.com/Items/Small/107707.jpg',
            title: 'Double Chip Cookie',
            per: 'A soft & chewy chocolate cookie topped with chocolate chips ...',
            price: 294,
        },
        {
            id: 4,
            image: 'https://starbucksstatic.cognizantorderserv.com/Items/Small/103515.jpg',
            title: 'Double Frappuccino',
            per:'  Rich mocha-flavored sauce meets up with chocolaty chips, mil...',
            price: 420,
        },
        {
            id: 5,
            image: 'https://starbucksstatic.cognizantorderserv.com/Items/Small/100100_1.png',
            title: 'Chicken  Sandwich',
            per: ' Marinated tandoori paneer filling, sliced cheese, and whole...',
            price: 283,
        },
        {
            id: 6,
            image: 'https://starbucksstatic.cognizantorderserv.com/Items/Small/115751_1.png',
            title: 'Cookie Creme Latte',
            per:" Handcrafted espresso from the world's top 3% Arabica with st...",
            price:430,
        },
        {
            id: 7,
            image: 'https://starbucksstatic.cognizantorderserv.com/Items/Small/115987.png',
            title: 'Classic Iced Coffee',
            per:'   Savour our premium coffee made with top 3% Arabica beans in ...',
            price: 236,
        },
        {
            id: 8,
            image: 'https://starbucksstatic.cognizantorderserv.com/Items/Small/115986.png',
            title: 'Classic Hot Coffee',
            per: 'Savour our premium coffee made with top 3% Arabica beans in ...',
            price:  157 ,         
        },
        {
            id: 9,
            image: 'https://starbucksstatic.cognizantorderserv.com/Items/Small/100512.jpg',
            title: 'Doppio Espresso',
            per: '   Our smooth signature Espresso Roast and its caramelly sweetn...',
            price: 278,       
        },
        {
            id: 10,
            image: 'https://starbucksstatic.cognizantorderserv.com/Items/Small/103973.jpg',
            title: 'Flat White',
            per: 'Expertly steamed milk poured over shots of ristretto and fin...',
            price: 330,
        },
        {
            id: 11,
            image: 'https://starbucksstatic.cognizantorderserv.com/Items/Small/107933.jpg',
            title: 'Hazelnut Cortado',
            per: ' A perfect espresso shot and hazelnut syrup, topped with stea...',
            price:  351,
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
                                <h4 class="text-center">${item.per}</h4>
                                <h3>₹ ${item.price}.00</h3>
                                <input type="hidden" name="Item_Name" value="${item.title}">
                                <input type="hidden" name="Price" value="${item.price}">
                                <button class='btn3 btn btn-success' type="submit" name="submit">Add Item</button>
                            </div>
                        </div>
                    </form>
                `;
            }).join('')
            : "<p class='text-danger text-center p'>No products found</p>";
    };

    displayItems(products);
});