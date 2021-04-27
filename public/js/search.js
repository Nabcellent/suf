/****************************  Enable Search  *****************************/

$(function() {
    $.fn.extend({
        filterTable: function() {
            return this.each(function() {
                $(this).on('keyup', function() {
                    let $this = $(this),
                        search = $this.val().toLowerCase(),
                        rows = $this.closest('div').next().find('li');

                    if(search === '') {
                        rows.show();
                    } else {
                        rows.each(function() {
                            let $this = $(this);
                            $this.text().toLowerCase().indexOf(search) === -1? $this.hide() : $this.show();
                        });
                    }
                });
            });
        }
    });

    $('[data-action="filter"][class="search_text"]').filterTable();
});
