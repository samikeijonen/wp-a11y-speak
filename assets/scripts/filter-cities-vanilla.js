// Import vanilla package for a11y speak.
import { speak } from '@wordpress/a11y';

/*
 * Filter cities.
 */
const speakExample = () => {
	// Filter form.
	const filterForm = document.getElementById( 'filter-cities' );

	// Bail if we do not have the form.
	if ( ! filterForm ) {
		return;
	}

	// Select city.
	const selectCity = document.getElementById( 'select-city' );

	// Get result element and default info.
	const showResults = document.getElementById( 'show-results' );

	// List people.
	const people = [
		{ name: 'Vellu', city: 'Kuorinka' },
		{ name: 'Sami', city: 'Kuorinka' },
		{ name: 'Esko', city: 'Kuorinka' },
		{ name: 'Irwin', city: 'Helsinki' },
		{ name: 'Luciref', city: 'Helsinki' },
		{ name: 'Matti', city: 'Helsinki' },
		{ name: 'Reetta', city: 'Kuopio' },
		{ name: 'Ossi', city: 'Kuopio' },
		{ name: 'Jussi', city: 'Joensuu' },
		{ name: 'Luke', city: 'Joensuu' },
		{ name: 'Hannu', city: 'Tampere' },
		{ name: 'Hilkka', city: 'Tampere' },
	  ];

	// Filter contacts via form input.
	function filter( e ) {
		// Don't reload the page.
		e.preventDefault();

		// Get city value.
		const whichCity = selectCity.value;

		// Filter only selected people based on city.
		const selected = people.filter( who => (who.city == whichCity ) );

		// Loop them in a list.
		let results = selected.map( match => `<li>${match.name}</li>`).join('').trim();

		// Populate filtered people inside the list.
		showResults.innerHTML = results;
	}

	// Filter contacts via form input.
	function filterCities( e ) {
		// Filter cities.
		filter( e );

		// Announce filtering result to screen readers. Default is "polite".
		speak( WPA11ySpeakText.successMessage1 );
	}

	// Filter contacts via form input.
	function filterDefaults( e ) {
		// Filter cities.
		filter( e );
	}

	// Listen when city selection have been changed.
	selectCity.addEventListener( 'change', filterCities );

	// Populate defaults on page load.
	window.addEventListener( 'load', filterDefaults );

	/*
	 * Fetch posts from REST API.
	 * @link: https://scotch.io/tutorials/how-to-use-the-javascript-fetch-api-to-get-data
	 */

	// REST URL.
	const restUrl = WPA11ySpeakText.restUrl;

	// Set posts element.
	const showPost = document.getElementById( 'show-posts' );

	// Select category from the form.
	const selectCategory = document.getElementById( 'select-category' );

	// Filter categories function.
	function filterCategories( e ) {
		// Don't reload the page.
		e.preventDefault();

		// Get category ID.
		const whichCategory = selectCategory.value;

		// Fetch posts.
		fetch( restUrl )
			.then( (resp) => resp.json() )
			.then( function( data ) {
			console.log( data );

			// Filter only selected category posts.
			const selectedCategory = data.filter( category => (category.categories == whichCategory ) );

			// Loop them in a list.
			let posts = selectedCategory.map( match => `<li>${match.title.rendered}</li>`).join('').trim();

			// Populate filtered posts inside the list.
			showPost.innerHTML = posts;

			// Announce filtering result to screen readers.
			speak( WPA11ySpeakText.successMessage2, 'assertive' );
		})
		.catch( function( error ) {
			console.log(error);
		})
	}

	// Listen when city selection have been changed.
	selectCategory.addEventListener( 'change', filterCategories );

	// Populate defaults on page load.
	window.addEventListener( 'load', filterCategories );
};

export default speakExample;
