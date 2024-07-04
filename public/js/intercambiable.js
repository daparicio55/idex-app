document.getElementById('btn-add').addEventListener('click', function() {
    var unidades = document.getElementById('unidades');
    var index = unidades.selectedIndex;
    var text = unidades.options[index].text;
    var table = document.getElementById('tb_unidades');
    var row = document.createElement('tr');
    row.setAttribute('id', 'row' + index);
    var td1 = document.createElement('td');
    var td2 = document.createElement('td');
    var btn = document.createElement('button');
    td1.innerHTML = text;
    btn.innerHTML = 'Eliminar';
    btn.classList.add('btn', 'btn-danger');
    btn.setAttribute('onclick', 'removeRow(' + index + ')');
    td2.appendChild(btn);
    row.appendChild(td1);
    row.appendChild(td2);
    table.appendChild(row);
    
});