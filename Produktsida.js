// En variabel f�r att h�lla reda p� pris�ndringar f�r olika valbara delar
let selectedOptions = {
    chassi: 0,
    ram: 0,
    cooling: 0,
    wifi: 0,
    ssd: 0,
    color: 0
};

let total_price = 8000; // S�tter grundpriset till 8000 kr

// Funktion f�r att visa och d�lja dropdown-menyer
function toggleDropdown(element) {
    const dropdown = element.nextElementSibling;
    const isOpen = dropdown.style.display === "block";

    // St�nger alla �ppna dropdowns innan man �ppnar en ny
    document.querySelectorAll(".dropdown-menu").forEach(menu => {
        menu.style.display = "none";
        menu.previousElementSibling.classList.remove("open");
    });

    if (!isOpen) {
        dropdown.style.display = "block";
        element.classList.add("open");
    }
}

// Funktion som hanterar n�r en anv�ndare v�ljer ett alternativ
function selectOption(optionElement, category, priceChange) {
    const dropdown = optionElement.closest(".dropdown-menu");
    const box = dropdown.previousElementSibling;
    const textElement = box.querySelector(".selectedText"); // Text f�r valt alternativ
    const hiddenInput = box.querySelector("input[type=hidden]"); // Dold input
    const selectedText = optionElement.querySelector("p").textContent; // H�mta den valda texten (t.ex. "Svart")
    const selectedPrice = optionElement.querySelector(".dropdown-p").textContent; // H�mta priset fr�n <span>

    // Uppdaterar texten s� att priset visas bredvid alternativet
    textElement.innerHTML = `${selectedText} <p class="selected-price">${selectedPrice}</p>`;
    hiddenInput.value = selectedText.trim(); // Uppdatera input-v�rdet

    // Justera pris�ndringarna
    total_price -= selectedOptions[category]; // Ta bort gammal pris�ndring
    selectedOptions[category] = priceChange; // Uppdatera med nya pris�ndringen
    total_price += priceChange; // L�gg till nya pris�ndringen

    document.getElementById("total_price").value = total_price; // Uppdatera det dolda prisf�ltet
    updatePriceDisplay(); // Uppdatera prisvisningen

    // St�ng dropdown-menyn efter val
    dropdown.style.display = "none";
    box.classList.remove("open");
}


// Uppdaterar prisvisningen p� sidan
function updatePriceDisplay() {
    let priceDisplay = document.getElementById("priceDisplay");

    // Skapar en prisskylt om den inte redan finns
    if (!priceDisplay) {
        priceDisplay = document.createElement("h2");
        priceDisplay.id = "priceDisplay";
        document.querySelector(".main-header-right").appendChild(priceDisplay);
    }

    // Uppdaterar prisskylten med det nya totalpriset
    priceDisplay.innerText = `Pris: ${total_price} kr`;
}

// St�nger alla dropdowns om anv�ndaren klickar utanf�r dem
document.addEventListener("click", function (event) {
    document.querySelectorAll(".dropdown-container").forEach(container => {
        if (!container.contains(event.target)) {
            container.querySelector(".dropdown-menu").style.display = "none";
            container.querySelector(".Chassibox").classList.remove("open");
        }
    });
});

updatePriceDisplay(); // Ser till att priset visas korrekt vid sidans start

