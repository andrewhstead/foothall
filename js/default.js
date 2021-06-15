function menuToggle(section) {
	
	if (window.innerWidth <= 800) {
		
		if (section === 'menu') {

			var sections = document.getElementsByClassName("toggle-items");

			for (var i = 0; i < sections.length; i++) {
				sections[i].classList.toggle("menu-items");
			}
			
		} else if (section === 'hall') {
		
			var icon = document.getElementById("hall-icon");
			
			if (icon.innerHTML === "+") {
				icon.innerHTML = "-";
			} else if (icon.innerHTML === "-") {
				icon.innerHTML = "+";
			}
				
			var sections = document.getElementsByClassName("hall-nested");

			for (var i = 0; i < sections.length; i++) {
				sections[i].classList.toggle("hall-item");
			}
			
		} else if (section === 'history') {
		
			var icon = document.getElementById("history-icon");
			
			if (icon.innerHTML === "+") {
				icon.innerHTML = "-";
			} else if (icon.innerHTML === "-") {
				icon.innerHTML = "+";
			}
				
			var sections = document.getElementsByClassName("history-nested");

			for (var i = 0; i < sections.length; i++) {
				sections[i].classList.toggle("history-item");
			}
			
		}
		
	}
	
}

function showMenu() {
	
	if (window.innerWidth > 800) {
		
		var sections = document.getElementsByClassName("nested");
		
		for (var i = 0; i < sections.length; i++) {
			sections[i].classList.remove("hidden");
		}
	}
	
}

function removeMenu() {
	
	if (window.innerWidth > 800) {
	
		var sections = document.getElementsByClassName("nested");
	
		for (var i = 0; i < sections.length; i++) {
			sections[i].classList.add("hidden");
		}
	
	}
	
}
