<div class="container-fluid d-flex justify-content-center ">
   <div class="col-4 ">
      <div class="row ">
         <div class="card text-center px-0 shadow">
            <div class="card-header fw-light fst-italic">
               Bienvenido: {{ auth()->user()->nombres }}
            </div>
            <div class="card-body">
               <h5 class="card-title fst-italic">Sistema de gestion de Notas</h5>
               <p class="card-text fw-light fst-italic">Plataforma</p>
               <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
            </div>
            <div class="card-footer fw-light fst-italic">
               Cisne
            </div>
         </div>
      </div>
   </div>
</div>