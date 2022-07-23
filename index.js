console.log("Live realod enabled!");

let filterButton = [...document.querySelectorAll("#filtered li")];
let specialProducts = document.querySelector(".special_products");
let filterInputs = document.querySelector(".filterInputs");

// filterInputs.addEventListener("keyup", (event) => {
//     let element = event.target;

//     filterItemByName(element);
// });

function filterItemByName(element) {
    let filterValue = element.value.toLowerCase();

    let items = [...specialProducts.querySelectorAll(".item")];

    items.forEach(item => {
        let itemName = item.querySelector(".product_name");
        
        if (itemName.textContent.toLowerCase().indexOf(filterValue) !== -1) {
            item.style.display = "block";
        }else{
            item.style.display = "none";
        }
    });
}

filterButton.forEach(button => {
    button.addEventListener("click", (event) => {
        let element = event.target;
        let filterName = element.dataset.filter;

        filterItemByBrand(filterName);
    });
});

function filterItemByBrand(filterName) {
    let items = [...specialProducts.querySelectorAll(".item")];

    items.forEach(item => {
        let itemBrand = item.querySelector(".product_brand");

        if (filterName === "All Brand") {
            item.style.display = "block";

            return;
        }

        if (itemBrand.textContent === filterName) {
            item.style.display = "block";
        }else{
            item.style.display = "none";
        }
    });
}