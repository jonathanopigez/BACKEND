$(function(){
    $('table').DataTable();

    // créer une facture


$('#create').on('click', function(e) {
        console.log('bonjour');
        let formOrder = $("#formOrder")
        if(formOrder[0].checkValidity()) {
            e.preventDefault();
            $.ajax({
                url: "process.php",
                type: 'post',
                data: formOrder.serialize() + '&action=create',
                success: function(response){
                    $('#createModal').modal('hide');
                     
                      Swal.fire({
                      
                      icon: 'success',
                      title: 'Succès',
                      
})
                    formOrder[0].reset();
                }
            })
        }
})
//Récupère les factures
getBills();
function getBills(){
    $.ajax({
        url: "process.php",
        type: 'post',
        data: {action: 'fetch'},
        success: function (response){
            $("#orderTable").html(response);
            $("table").DataTable({order: [0, "desc"]});
            
        }
    })
}

        $("body").on("click", '.editBtn', function(e){
                e.preventDefault();
                $.ajax({
                    url:'process.php',
                    type: 'post',
                    data: {workingId: this.dataset.id},
                    success: function(response){
                        let billInfo = JSON.parse(response);
                        $("#customerUpdate").val(billInfo.customer);
                        $("#cashierUpdate").val(billInfo.cashier);
                        $("#amountUpdate").val(billInfo.amount);
                        $("#receivedUpdate").val(billInfo.received);
                        let select = document.querySelector("#statesUpdate");
                        let statesOption = Array.from(select.options);
                        statesOption.forEach((o, i) => {
                                    if(o.value == billInfo.states) select.selectedIndex = i;
                        })
                    }
                })
        })

});