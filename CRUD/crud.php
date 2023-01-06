<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="http://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="style.css">
  <title>CRUD AJAX</title>
</head>
<body>



<header>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><i class="fas fa-user-secret"></i> Jdev</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
        
        <li class="nav-item">
          <a class="nav-link disabled">Disabled</a>
        </li>
      </ul>
      <form class="d-flex">
        
      </form>
    </div>
  </div>
</nav>
</header>
<section class="container py-5">

  <div class="row">
    <div class="col-lg-8 col-sm mb-5 mx-auto">
      <h1 class="fs-4 text-center lead text-primary">CRUD PHP MYSQL AJAX</h1>
    </div>
  </div>
  <div class="dropdown-divider border-warning"></div>
  <div class="row">
    <div class="col-md-6">
      <h5 class="fw-bold mb-8">Liste des factures</h5>
    </div>
    <div class="col-md-6">
      <div class="d-flex justify-content-end">
        <button class="btn btn-primary btn-sm me-3 fs-8 p-2"><i class="fas fa-folder-plus"
        data-bs-toggle="modal" data-bs-target="#createModal"> Nouveau</i></button>
        <a href="#" class="btn btn-success btn-sm me-3 fs-8 p-2" id="export"><i class="fas fa-table"> Exporter</i></a>
      </div>
    </div>
  </div>
  <div class="dropdown-divider border-warning"></div>
  <div class="row">
    <div class="table-responsive" id="orderTable">
   
<h3 class="text-success text-center">Chargement des factures...</h3>

    </div>
  </div>
</section>


<!-- Modal -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createModalLabel">Nouvelle facture</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="post" id="formOrder">
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="customer" name="customer">
            <label for="customer">Nom du client</label>
          </div>
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="cashier" name="cashier">
            <label for="cashier">Nom du caissier</label>
          </div>
          <div class="row g-2">
            <div class="col-md">
              <div class="form-floating mb-3">
              <input type="text" class="form-control" id="amount" name="amount">
              <label for="amount">Montant</label>
              </div>
            </div>
            <div class="col-md">
              <div class="form-floating mb-3">
              <input type="text" class="form-control" id="received" name="received">
              <label for="received">Montant perçu</label>
              </div>
            </div>
            <div class="col-md">
              <div class="form-floating">
                <select name="states" id="states" class="form-select" aria-label="states">
                  <option value="Facturée">Facturée</option>
                  <option value="Payée">Payée</option>
                  <option value="Annulée">Annulée</option>
                </select>
                <label for="states">Etat</label>
              </div>
            </div>
          </div>
        </form>




      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
        <button type="button" class="btn btn-primary" name="create" id="create">Ajouter <i class="fas fa-plus"></i></button>
      </div>
    </div>
  </div>
</div>

<!-- updateModal -->
<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="updateModalLabel">Modifier facture</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="post" id="formUpdateOrder">
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="customerUpdate" name="customer">
            <label for="customerUpdate">Nom du client</label>
          </div>
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="cashierUpdate" name="cashier">
            <label for="cashierUpdate">Nom du caissier</label>
          </div>
          <div class="row g-2">
            <div class="col-md">
              <div class="form-floating mb-3">
              <input type="text" class="form-control" id="amountUpdate" name="amount">
              <label for="amountUpdate">Montant</label>
              </div>
            </div>
            <div class="col-md">
              <div class="form-floating mb-3">
              <input type="text" class="form-control" id="receivedUpdate" name="receive">
              <label for="receivedUpdate">Montant perçu</label>
              </div>
            </div>
            <div class="col-md">
              <div class="form-floating">
                <select name="statesUpdate" id="statesUpdate" class="form-select" aria-label="statesUpdate">
                  <option value="Facturée">Facturée</option>
                  <option value="Payée">Payée</option>
                  <option value="Annulée">Annulée</option>
                </select>
                <label for="statesUpdate">Etat</label>
              </div>
            </div>
          </div>
        </form>




      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
        <button type="button" class="btn btn-primary" name="update" id="update">Mettre à jour <i class="fas fa-sync"></i></button>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="http://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="process.js"></script>
</body>
</html>