const reversibleCards = document.querySelectorAll(".reversible-card");

function flipReversibleCards() {
    reversibleCards.forEach((reversibleCard) => {
        reversibleCard.addEventListener("click", () => {
            reversibleCard.classList.toggle("flipcard");
        });
    });
}

document.addEventListener("DOMContentLoaded", function () {
    flipReversibleCards();
    console.log("DOM fully loaded and parsed");
});