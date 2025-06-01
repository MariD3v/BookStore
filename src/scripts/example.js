
function getProductById(id){
    fetch(`/api/productbyid.php?id=${id}`)
    .then(response => response.json())
    .then(data => {
        console.log(data);
    })
    .catch(error => {
        console.error('Ha ocurrido un error:', error);
    });
}

getProductById(1);