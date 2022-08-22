document.querySelector('form').onsubmit = function (event) {
    event.preventDefault();
    const data = new FormData(this);
    data.getAll('images[]').forEach((image, index) => {
        console.log(index);

    });
    if (data.getAll('images[]')[0].size) {
        fetch(this.action, {
            method: 'post',
            body: data
        })
            .then((res) => res.json)
            .then((data) => {
                console.log(data);
            });
    }

}