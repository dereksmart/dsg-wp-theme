(function () {
	function setTheme(theme) {
		document.documentElement.setAttribute('data-theme', theme);
		try { localStorage.setItem('dsg-theme', theme); } catch (e) {}
	}

	function currentTheme() {
		return document.documentElement.getAttribute('data-theme') === 'dark' ? 'dark' : 'light';
	}

	function wire() {
		var buttons = document.querySelectorAll('.dsg-theme-toggle');
		buttons.forEach(function (btn) {
			btn.addEventListener('click', function () {
				setTheme(currentTheme() === 'dark' ? 'light' : 'dark');
			});
		});
	}

	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', wire);
	} else {
		wire();
	}
})();
