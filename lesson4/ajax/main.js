/*
<div class="card col-4" style="width: 18rem;">
    <img class="card-img-top" src=".../100px180/" alt="Card image cap">
    <div class="card-body">
        <h5 class="card-title">Название карточки</h5>
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        <a href="#" class="btn btn-primary">Переход куда-нибудь</a>
    </div>
</div>
*/


$(document).ready(function () {
  var elems;
  var ids = 1;
  elems = http(ids);
  render(elems);

  $('.js-more').click(function(){
    ids +=25;
    var elem = http(ids);
    render(elem);
  });
});

function http(id) {
  var elem;
  $.ajax({
    url: `ajax.php?id=${id}`,
    async: false,
    success: function (data) {
      elem = JSON.parse(data);
    }
  });
  return elem;
}

function render(arr) {
  var catalog = $('#js-catalog');
  arr.forEach(card => {
    var elem = $('<div/>', {
      class: "card col-4 mt-2"
    });
    elem.html(`
      <div class="card-body">
        <img class="card-img-top" src="${card.img}" alt="Card image cap">
        <h5 class="card-title">${card.name}</h5>
        <p class="card-text">Price: ${card.price}</p>
      </div>
    `);
    elem.appendTo(catalog);
  });
}