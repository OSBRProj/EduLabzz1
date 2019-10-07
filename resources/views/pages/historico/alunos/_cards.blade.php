<div class="col-md-4 col-lg-4 mb-sm-4">
    <div class="bg-white rounded-10">
        <div class="d-xl-flex justify-content-xl-start">
            <div>
                <img
                    width="220"
                    src="https://image.freepik.com/free-photo/blackboard-with-math-problem_23-2147849663.jpg"
                    alt="">
            </div>
            <div class="p-4">
                <p class="text-primary">{{ $historico->conteudo->titulo }}</p>
                <small
                    class="text-type font-weight-bold">{{ $historico->conteudo->present()->conteudoTipo }}</small>
                <div class="d-lg-flex justify-content-between mt-3">
                    <small class="mr-lg-4">4 ANO</small>
                    <span
                        class="badge badge-success d-flex justify-content-center align-items-center rounded-10">FÍSICA</span>
                </div>
                <div class="mt-3">
                    <small class="mr-lg-4">
                        Acesso em:
                        <strong>{{ date('d/m/Y', strtotime($historico->created_at)) }}
                            às {{ date('H:i', strtotime($historico->created_at)) }}</strong>
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>
