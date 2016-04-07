var lang = document.documentElement.getAttribute ('lang');

// Auto-select the auto-focused input (if any)
setTimeout (function () {
  var e = document.activeElement;
  if (e && e.tagName == 'INPUT')
    e.select ();
});

/*
 * DataTables.net integration
 */
$ ('.dataTable').each (function () {
  var table = $ (this)
    , href  = table.attr ('data-detail-url');
  table.dataTable ({
    paging:       true,
    lengthChange: true,
    searching:    true,
    ordering:     true,
    info:         true,
    autoWidth:    false,
    responsive:   true,
    pageLength:   10,
    lengthMenu:   [5, 10, 15, 20, 50, 100],
    pagingType:   'simple_numbers',
    serverSide:   false,
    language:     lang != 'en' ? { url: 'js/datatables/' + lang + '-' + lang.toUpperCase() + '.json' } : null,
    initComplete: function () {
      table.show ();
    },
    drawCallback: function () {
      var p = $ ('#' + table.attr ('id') + '_wrapper .pagination');
      p.css ('display', p.children (':visible').length == 1 ? 'none' : '');
    }
  });
  if (href)
    table.on ('click', 'div', function (ev) {
      location.href = href + ev.target.parentElement.parentElement.getAttribute ('data-id');
    });
});
