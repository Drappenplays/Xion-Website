// En variabel för att hålla reda på prisändringar för olika valbara delar
let selectedOptions = {
    chassi: 0,
    ram: 0,
    cooling: 0,
    wifi: 0,
    ssd: 0,
    color: 0
};

let total_price = 8000; // Sätter grundpriset till 8000 kr

// Funktion för att visa och dölja dropdown-menyer
function toggleDropdown(element) {
    const dropdown = element.nextElementSibling;
    const isOpen = dropdown.style.display === "block";

    // Stänger alla öppna dropdowns innan man öppnar en ny
    document.querySelectorAll(".dropdown-menu").forEach(menu => {
        menu.style.display = "none";
        menu.previousElementSibling.classList.remove("open");
    });

    if (!isOpen) {
        dropdown.style.display = "block";
        element.classList.add("open");
    }
}

// Funktion som hanterar när en användare väljer ett alternativ
function selectOption(optionElement, category, priceChange) {
    const dropdown = optionElement.closest(".dropdown-menu");
    const box = dropdown.previousElementSibling;
    const textElement = box.querySelector(".selectedText"); // Text för valt alternativ
    const hiddenInput = box.querySelector("input[type=hidden]"); // Dold input
    const selectedText = optionElement.querySelector("p").textContent; // Hämta den valda texten (t.ex. "Svart")
    const selectedPrice = optionElement.querySelector(".dropdown-p").textContent; // Hämta priset från <span>

    // Uppdaterar texten så att priset visas bredvid alternativet
    textElement.innerHTML = `${selectedText} <p class="selected-price">${selectedPrice}</p>`;
    hiddenInput.value = selectedText.trim(); // Uppdatera input-värdet

    // Justera prisändringarna
    total_price -= selectedOptions[category]; // Ta bort gammal prisändring
    selectedOptions[category] = priceChange; // Uppdatera med nya prisändringen
    total_price += priceChange; // Lägg till nya prisändringen

    document.getElementById("total_price").value = total_price; // Uppdatera det dolda prisfältet
    updatePriceDisplay(); // Uppdatera prisvisningen

    // Stäng dropdown-menyn efter val
    dropdown.style.display = "none";
    box.classList.remove("open");
}


// Uppdaterar prisvisningen på sidan
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

// Stänger alla dropdowns om användaren klickar utanför dem
document.addEventListener("click", function (event) {
    document.querySelectorAll(".dropdown-container").forEach(container => {
        if (!container.contains(event.target)) {
            container.querySelector(".dropdown-menu").style.display = "none";
            container.querySelector(".Chassibox").classList.remove("open");
        }
    });
});

updatePriceDisplay(); // Ser till att priset visas korrekt vid sidans start

