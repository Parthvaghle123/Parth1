document.addEventListener("DOMContentLoaded", () => {
    const products = [
        {
            id: 0,
            image: 'https://preprodtsbstorage.blob.core.windows.net/cms/uploads/TSB_GC_indiacard_1_1_28dafb2bb6.png',
            title: 'India Exclusive',
            per:'Bring in the festive season and make each celebration memorable.'

        },
        {
            id: 1,
            image: 'https://preprodtsbstorage.blob.core.windows.net/cms/uploads/71d3780c_be6e_46b1_ab01_8a2bce244a7f_1_1_2d1afadaa0.png',
            title: 'Starbucks Coffee',
            per: ' Starbucks is best when shared. Treat your pals to a good cup of coffee.'
        },
        {
            id: 2,
            image: 'https://preprodtsbstorage.blob.core.windows.net/cms/uploads/7c6f7c64_3f89_4ba2_9af8_45fc6d94ad35_1_1bdd3bf075.webp',
            title: 'Keep Me Warm',
            per:'  Captivating, cosy, coffee. Gift your loved ones this Starbucks Gift Card.'
        },
        {
            id: 3,
            image: 'https://preprodtsbstorage.blob.core.windows.net/cms/uploads/ff96761f_7c0a_4960_84a8_2a94c7d994fc_f59ad13bec.png',
            title: 'Good Things Ahe',
            per: 'Have a cup of coffee, its all good from here.'
        },
        {
            id: 4,
            image: 'https://preprodtsbstorage.blob.core.windows.net/cms/uploads/2822e4c5_38ff_422a_a225_cfc3a6bdfc06_1_fdcaafd8bd.png',
            title: 'My Treat',
            per:'  Nothing like a cup of coffee to flame a friendship. Share the experience with your..'
        },
        {
            id: 5,
            image: 'https://preprodtsbstorage.blob.core.windows.net/cms/uploads/61c1abaf_3b0f_48af_903e_426c1b9dae41_1_9a59b0ea34.webp',
            title: 'Way To Go',
            per: ' Its time to celebrate! Show your appreciation with this Starbucks Gift Card.'
        },
        {
            id: 6,
            image: 'https://preprodtsbstorage.blob.core.windows.net/cms/uploads/49bc224d_6ad8_46db_a46f_9ce256321659_1_2d7d101557.png',
            title: 'Greetings',
            per:"Let each 'hello' be one with coffee."
        },
        {
            id: 7,
            image: 'https://preprodtsbstorage.blob.core.windows.net/cms/uploads/483b8a72_214b_47d4_81a1_ad9187f5f50b_1_a449d5551b.png',
            title: 'Global Spring Card',
            per:'   Blissful, blooming, and bright. Spring is a merry time. Keep things fresh and lively.'
        },
        {
            id: 8,
            image: 'https://preprodtsbstorage.blob.core.windows.net/cms/uploads/10471f55_db43_4633_8f4a_a2b8408abeea_1_dc2f4669f7.webp',
            title: 'Are The Best Just Sayin',
            per: 'Think theyre the Nitro to your Brew? Let them know..'
        },
        {
            id: 9,
            image: 'https://preprodtsbstorage.blob.core.windows.net/cms/uploads/97ee3280_2f05_43ad_bd94_f5c184d4f502_1_0a31455af9.png',
            title: 'Congrats',
            per: '   Coffee. Cheer. Celebrate. Enjoy each of your special moments withStarbucks.'
        },
        {
            id: 10,
            image: 'https://preprodtsbstorage.blob.core.windows.net/cms/uploads/720b9684_c1ac_49cb_92fe_a7e0240c9602_1_1_faf8b923e5.webp',
            title: 'Thank You',
            per: 'To the people who make coffee and those who love it, thank you..'

        },
        {
            id: 11,
            image: 'https://preprodtsbstorage.blob.core.windows.net/cms/uploads/0807fba8_293b_407b_a973_c5eaad1c73fa_1_11692c064d.png',
            title: 'Life Happens',
            per: 'Life happens, coffee helps. Brighten up their day with Starbucks.'
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
        let rootElement = document.getElementById('root');

        if (!rootElement) {
            console.error("Element with ID 'root' not found!");
            return;
        }

        rootElement.innerHTML = items.length > 0
            ? items.map((item) => {
                return `
                    <div class='box'>
                        <div class='img-box'>
                            <img class='images' src="${item.image}" alt="${item.title}">
                        </div>
                        <div class='bottom'>
                            <h2>${item.title}</h2>
                            <h4>${item.per}</h4>
                            <button class='btn3 btn btn-secondary'disabled>Add Item</button>
                        </div>
                    </div>
                `;
            }).join('')
            : "<p class='text-danger text-center p'>No products found</p>";
    };

    displayItems(products);
});
