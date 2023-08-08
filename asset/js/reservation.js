function updateTotal() {
    var arrivee = new Date(document.querySelector('input[name="arrivee"]').value);
    var depart = new Date(document.querySelector('input[name="depart"]').value);
    var personnes = document.getElementById('input-select').value;

    var oneDay = 24 * 60 * 60 * 1000;
    var numberOfNights = Math.round(Math.abs((depart - arrivee) / oneDay));

    var pricePerNight = parseFloat(document.getElementById('price-per-night').dataset.price); // récupérer le prix par nuit depuis l'élément HTML

    var subTotal = numberOfNights * pricePerNight * personnes;
    var taxe = subTotal * 0.05;
    var total = subTotal + taxe;

    // Mettre à jour les champs cachés du formulaire
    document.getElementById('duration').value = numberOfNights;
    document.getElementById('total').value = total;

    document.getElementById('price-per-night-display').textContent = pricePerNight.toFixed(2) + '€';
    document.getElementById('num-nights').textContent = numberOfNights + ' nuits';
    document.getElementById('sub-total-span').textContent = subTotal.toFixed(2);
    document.getElementById('tax-total-span').textContent = taxe.toFixed(2);
    document.getElementById('total-span').textContent = total.toFixed(2);  // Afficher le total dans le span avec l'id total-span
}

document.querySelector('input[name="arrivee"]').addEventListener('change', updateTotal);
document.querySelector('input[name="depart"]').addEventListener('change', updateTotal);
document.getElementById('input-select').addEventListener('change', updateTotal);
