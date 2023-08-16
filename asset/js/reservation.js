function parseDate(dateStr) {
    var parts = dateStr.split('-');
    if (parts.length !== 3) return null;
    return new Date(parts[2], parts[1] - 1, parts[0]);  // Année, Mois (0-indexed), Jour
}

function updateTotal() {
    var arrivee = parseDate(document.querySelector('input[name="arrivee"]').value);
    var depart = parseDate(document.querySelector('input[name="depart"]').value);

    if (!arrivee || !depart) return; // si les dates ne sont pas valides

    var oneDay = 24 * 60 * 60 * 1000;
    var numberOfNights = Math.round(Math.abs((depart - arrivee) / oneDay));

    var pricePerNight = parseFloat(document.getElementById('price-per-night').dataset.price);

    var subTotal = numberOfNights * pricePerNight;
    var taxe = subTotal * 0.05;
    var total = subTotal + taxe;

    // Mettre à jour les champs cachés du formulaire
    document.getElementById('duration').value = numberOfNights;
    document.getElementById('total').value = total;

    document.getElementById('price-per-night-display').textContent = pricePerNight.toFixed(2) + '€';
    document.getElementById('num-nights').textContent = numberOfNights + ' nuits';
    document.getElementById('sub-total-span').textContent = subTotal.toFixed(2);
    document.getElementById('tax-total-span').textContent = taxe.toFixed(2);
    document.getElementById('total-span').textContent = total.toFixed(2);
}

document.querySelector('input[name="arrivee"]').addEventListener('change', updateTotal);
document.querySelector('input[name="depart"]').addEventListener('change', updateTotal);
document.getElementById('input-select').addEventListener('change', updateTotal);