/* Function for opening lightbox when an image is clicked. */
function openBox(category, type, detail, ending) {

	/* When an image is clicked, display the lightbox element. */
	document.getElementById("lightbox").classList.remove("hidden");

	/* Select an image and put its HTML in the lightbox element. */
	document.getElementById("box-image").innerHTML = '<img src="img/' + category + '/' + type + '/' + detail + '.' + ending + '" alt="Set PHP Here" />';
	
}

/* When the close icon is clicked, hide the lightbox element. */
function closeBox() {
	document.getElementById("lightbox").classList.add("hidden");
}
