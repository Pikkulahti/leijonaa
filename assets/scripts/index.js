/**
 * Index JS controller.
 */

// Use jQuery as $ within this file scope.
const $ = jQuery;

/**
 * Class Index
 */
class Index {

    constructor() {
    }

  /**
   * Contains DOM elements for caching.
   */
  cache() {
    this.loadMoreButton = document.getElementById('article-loadmore');
    this.newsContainer = document.getElementById('article-container');
    if (this.loadMoreButton) {
        this.maxPages = this.loadMoreButton.dataset.maxpages;
        this.page = this.loadMoreButton.dataset.page;
    }
  }

  /**
   * Contains all event listeners.
   */
  events() {
      if (this.loadMoreButton) {
          this.loadMoreButton.addEventListener('click', e => this.loadMore(e));
      }
  }

  /**
   * Fires on load more click on the news page.
   * Fetches more news results for the initial search query.
   *
   */
  loadMore() {
    this.loadMoreButton.disabled = true;
    this.loadMoreButton.className += ' loading';
    this.loadMoreButton.innerHTML = 'Ladataan';

    dp('Index/News', {
        partial: 'news-list',
        success: data => this.loadSuccess(data),
        error: error => {
          console.log(error);
        },
      });
  };

  loadSuccess(data) {
    this.page++;
    this.newsContainer.innerHTML += ( data );
    if (this.page >= this.maxPages ) {
        this.loadMoreButton.parentNode.removeChild(this.loadMoreButton);
    } else {
        this.loadMoreButton.disabled = false;
        this.loadMoreButton.innerHTML = 'Lataa lisää';
    }

    if (window.history) {

      // The url contains a page
      if (/sivu/.test(location.pathname)) {

        // Replace the current location with the new state.
        var path = location.pathname.replace(/sivu\/(\d+)/, 'sivu/' + this.page);

        // Push and change the full location path.
        window.history.pushState({}, 'Sivu', path);
      } else {

        // Push the state to the end of the current location.
        var url = 'sivu/' + this.page + '/';
        window.history.pushState({}, 'Sivu', url );
      }
    }
  }

  /**
   * Run when the document is ready.
   */
  docReady() {
    this.cache();
    this.events();
  }
}

module.exports = Index;
