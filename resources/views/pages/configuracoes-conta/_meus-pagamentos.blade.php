<style>
    .table-transferencias > thead > tr {
        color: #999FB4;
    }

    .table-transferencias > tbody > tr {
        color: #999FB4;
        box-shadow: 0 6px 3px -3px rgba(0, 0, 0, 0.1);
        border-bottom-left-radius: 10px;
        border-bottom-right-radius: 10px;
    }
</style>

<div class="tab-pane fade" id="pagamentos" role="tabpanel" aria-labelledby="v-pills-pagamentos-tab">

    <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
        {{-- <li class="nav-item mx-auto">
            <a class="nav-link active" id="meios_pagamentos-tab" data-toggle="tab"
               href="#meios_pagamentos"
               role="tab" aria-controls="meios_pagamentos" aria-selected="true">
                Meios de pagamento
            </a>
        </li> --}}
        <li class="nav-item mx-auto">
            <a class="nav-link active" id="transacoes-tab" data-toggle="tab" href="#transacoes"
               role="tab" aria-controls="transacoes" aria-selected="false">Transações</a>
        </li>
    </ul>

    <div class="tab-content" id="myTabContent">

        {{-- <div class="tab-pane fade show active" id="meios_pagamentos" role="tabpanel"
             aria-labelledby="meios_pagamentos-tab">

            <p class="text-center">Desculpe, mas não há meios de pagamento cadastrados para essa conta</p>

        </div> --}}

        <div class="tab-pane fade show active" id="transacoes" role="tabpanel"
             aria-labelledby="transacoes-tab">

            {{-- <div class="table-responsive-sm">
                <table class="table table-borderless table-transferencias">
                    <thead>
                    <tr>
                        <th scope="col">DATA DA <br> TRANSFERÊNCIA</th>
                        <th scope="col">CURSO</th>
                        <th scope="col">AUTOR</th>
                        <th scope="col">VALOR</th>
                    </tr>
                    </thead>
                    <tbody>

                    <tr>
                        <td>02/03/18</td>
                        <td class="font-weight-bold">Lorem ipsum dolor sit amet, consceceur</td>
                        <td>João Pedro</td>
                        <td>R$ <br> 1.500,00</td>
                    </tr>

                    </tbody>
                </table>
            </div> --}}

            <div class="row">
                <div class="col-6">
                    <h5 class="text-lightgray mb-4 font-weight-bold">
                        {{ count($transacoes) }} Compra{{ count($transacoes) != 1 ? 's' : '' }}
                    </h5>
                </div>
                <div class="col-6 text-right">
                    <h5 class="text-lightgray mb-4 font-weight-bold">
                        <span class="text-bluegray">Total: </span>
                        R$ {{ number_format($totalGasto, 2) }}
                    </h5>
                </div>
            </div>

            <div class="table-offset">
                <table class="table table-hover mb-0">
                    <thead class="thead-default">
                        <tr style="background-color: #F8F8F8;">
                            <th class="font-weight-bold">Id</th>
                            <th class="font-weight-bold">Referência</th>
                            <th class="font-weight-bold">Produtos</th>
                            <th class="">Status</th>
                            <th class="">Data</th>
                            <th class="">Sub-total</th>
                            <th class="">Frete</th>
                            <th class="">Adicional</th>
                            <th class="">Desconto</th>
                            <th class="">Total</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">

                        @if(count($transacoes) == 0)
                            <tr class="rounded shadow-sm">
                                <td colspan="10" class="text-center">Você ainda não realizou nenhuma transação.</td>
                            </tr>
                        @endif

                        @foreach ($transacoes as $transacao)
                            <tr class="rounded shadow-sm">
                                {{--  {{ dd($transacao) }}  --}}
                                <td class="font-weight-bold">{{ $transacao->id }}</td>
                                <td class="font-weight-bold">{{ $transacao->referencia_id }}</td>
                                <td class="font-weight-bold">
                                    @foreach ($transacao->produtos as $produto)
                                        {{ ucfirst($produto->titulo) }}{{ count($transacao->produtos) > 1 ? ', ' : '' }}
                                    @endforeach
                                </td>
                                <td>
                                    <span class="d-block text-center p-2 text-white text-uppercase rounded" style="background-color: {{ $transacao->status == 3 || $transacao->status == 4 ? '#3CD689' : '#FF9747' }};">{{ $transacao->status_name }}</span>
                                </td>
                                <td>{{ $transacao->created_at->format('d/m/Y \à\s H:i:s') }}</td>
                                <td>R$ {{ number_format($transacao->sub_total, 2) }}</td>
                                <td>R$ {{ number_format($transacao->frete, 2) }}</td>
                                <td>R$ {{ number_format($transacao->adicional, 2) }}</td>
                                <td>R$ {{ number_format($transacao->desconto, 2) }}</td>
                                <td>R$ {{ number_format($transacao->total, 2) }}</td>
                            </tr>
                            <tr class="spacer" style="height: 10px;"></tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

        </div>
    </div>


</div>
