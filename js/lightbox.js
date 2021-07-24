/* Function for opening lightbox when an image is clicked. */
function openBox(month, imagePosition) {

	/* When an image is clicked, display the lightbox element. */
	document.getElementById("lightbox").classList.remove("hidden");

	/* Select an image from the gallery and put its HTML in the lightbox element. */
	chosenImage = imagePosition;
	activeMonth = month;
	document.getElementById("box-image").innerHTML = '<img src="img/positions/generic/inside_left.png" alt="Set PHP Here" />';
	
}

/* When the close icon is clicked, hide the lightbox element. */
function closeBox() {
	document.getElementById("lightbox").classList.add("hidden");
}
