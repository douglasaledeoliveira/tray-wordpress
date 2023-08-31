document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.product-item').forEach(function(item) {
        item.addEventListener('click', function() {
            const productId = this.getAttribute('data-id');
            var ajaxurl = myScriptParams.site_url + '/wp-admin/admin-ajax.php';

            fetch(ajaxurl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `action=increment_product_visits&product_id=${productId}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log("Visita incrementada com sucesso");
                } else {
                    console.log("Falha ao incrementar a visita");
                }
            })
            .catch(error => {
                console.log("Erro: ", error);
            });
        });
    });
});
