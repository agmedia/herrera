'use strict';

function MakasbSaveToLocalStorage() {
    let list_categories_collection = document.getElementById('list_categories').getElementsByClassName('list-group-item');
    let list_categories = {};
    for (let category of list_categories_collection) {
        let id = category.dataset.id;
        let sort = category.dataset.sort;
        let parrent = category.dataset.parrent;
        list_categories[id] = {id: id, sort: sort, parrent: parrent};
    }
    localStorage.setItem('list_categories', JSON.stringify(list_categories));
}
function MakasbSortable(nestedSortables, callback) {
    for (var i = 0; i < nestedSortables.length; i++) {
        new Sortable(nestedSortables[i], {
            group: 'nested',
            animation: 150,
            fallbackOnBody: true,
            swapThreshold: 0.65,

            onEnd: function (evt) {
                let sortIndexTo = 0;
                for (let category of evt.to.getElementsByClassName('list-group-item')) {
                    category.dataset.sort = sortIndexTo++;
                    category.dataset.parrent = category.parentElement.closest('.list-group-item') !== null ? category.parentElement.closest('.list-group-item').dataset.id : 0;
                }
                callback();
            },

        });
    }
}

document.addEventListener("DOMContentLoaded", function() {
    MakasbSaveToLocalStorage();
    MakasbSortable([].slice.call(document.querySelectorAll('.nested-sortable')), MakasbSaveToLocalStorage);
});
