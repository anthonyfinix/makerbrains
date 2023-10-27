jQuery(document).ready(function ($) {
  let searchWrapper = $(".main-search-wrapper");
  let searchResultsWrapper = $(".search-results-wrapper");
  let searchForm = searchWrapper.find("#search-form");
  let searchInput = searchWrapper.find("#search-input");
  let nonce = searchInput.attr("data-nonce");
  let queryTimeout;
  let timeout = 1500;
  function searchProduct(searchTerm, nonce) {
    return $.ajax({
      type: "post",
      url: ajax_search_object.ajax_url + "?nonce=" + nonce,
      data: {
        action: "ajax_search",
        search: searchTerm,
        _wpnonce: nonce,
      },
    });
  }
  function hideSearchResultDropdown(event) {
    if (
      !searchWrapper.is(event.target) &&
      !searchWrapper.has(event.target).length
    ) {
      searchResultsWrapper.css("display", "none");
      searchResultsWrapper.empty();
      $(document).off("click", hideSearchResultDropdown);
    }
  }

  searchInput.on("input", function (e) {
    const searchTerm = e.target.value;
    if (queryTimeout) clearTimeout(queryTimeout);
    if (searchTerm === "") {
      searchResultsWrapper.css("display", "none");
      searchResultsWrapper.empty();
      return;
    }
    queryTimeout = setTimeout(() => {
      searchProduct(searchTerm, nonce).then((data) => {
        searchResultsWrapper.html(data);
        if (searchResultsWrapper.css("display") === "none") {
          searchResultsWrapper.css("display", "block");
          $(document).on("click", hideSearchResultDropdown);
        }
      });
    }, timeout);
  });
});
