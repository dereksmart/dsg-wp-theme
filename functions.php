<?php
/**
 * DSG Theme — functions.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function dsg_theme_extras() {
	$css = "
		a { text-decoration: none; transition: color 0.2s; }
		p a, li a { border-bottom: 1px solid rgba(37,99,235,0.3); }
		p a:hover, li a:hover { border-bottom-color: currentColor; }
		.wp-block-navigation a { border-bottom: none; }
		.wp-block-site-title a { border-bottom: none; }
		body { -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; }
		::selection { background: #2563eb; color: #fff; }

		/* Dark mode palette overrides — only the preset CSS vars change, every
		   block style that already references them follows automatically. */
		html[data-theme='dark'] {
			--wp--preset--color--base: #15151a;
			--wp--preset--color--contrast: #ececea;
			--wp--preset--color--accent: #6b9bff;
			--wp--preset--color--muted: #a4a29c;
			--wp--preset--color--subtle: #1f1f24;
			--wp--preset--color--faint: #6e6c66;
			--wp--preset--color--surface: #1a1a1f;
			--wp--preset--color--border: #2e2e34;
			color-scheme: dark;
		}
		html[data-theme='dark'] ::selection { background: #6b9bff; color: #0b0b10; }
		html[data-theme='dark'] p a, html[data-theme='dark'] li a {
			border-bottom-color: rgba(107,155,255,0.4);
		}

		/* Toggle button. */
		.dsg-theme-toggle {
			display: inline-flex;
			align-items: center;
			justify-content: center;
			width: 32px;
			height: 32px;
			padding: 0;
			background: transparent;
			border: 1px solid var(--wp--preset--color--border);
			border-radius: 999px;
			color: var(--wp--preset--color--muted);
			cursor: pointer;
			transition: color 0.2s, border-color 0.2s;
		}
		.dsg-theme-toggle:hover { color: var(--wp--preset--color--accent); border-color: var(--wp--preset--color--accent); }
		.dsg-theme-toggle svg { width: 16px; height: 16px; display: block; }
		.dsg-theme-toggle .dsg-icon-moon { display: none; }
		html[data-theme='dark'] .dsg-theme-toggle .dsg-icon-sun { display: none; }
		html[data-theme='dark'] .dsg-theme-toggle .dsg-icon-moon { display: block; }
	";
	wp_add_inline_style( 'global-styles', $css );

	wp_enqueue_script(
		'dsg-dark-mode',
		get_theme_file_uri( 'assets/dark-mode.js' ),
		array(),
		'1.0.0',
		array( 'in_footer' => true, 'strategy' => 'defer' )
	);
}
add_action( 'wp_enqueue_scripts', 'dsg_theme_extras', 20 );

/**
 * Print the initial theme as early as possible to avoid a flash of light
 * content for visitors who prefer (or have stored) dark mode.
 */
function dsg_theme_preference_script() {
	?>
	<script>
		(function () {
			try {
				var stored = localStorage.getItem('dsg-theme');
				document.documentElement.setAttribute('data-theme', stored === 'dark' ? 'dark' : 'light');
			} catch (e) {
				document.documentElement.setAttribute('data-theme', 'light');
			}
		})();
	</script>
	<?php
}
add_action( 'wp_head', 'dsg_theme_preference_script', 0 );
