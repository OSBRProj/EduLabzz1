<style>
    .radio-group {
        position: relative;
    }
    .radio {
        display: inline-block;
        width: 20px;
        height: 20px;
        margin-bottom: 15px;
        margin-right: 15px;
        background-color: #dedede;
        cursor: pointer;
    }
    .radio.selected {
        border-color: #4d565f;
        background: #4d565f;
        color: #fff;
        line-height: 7;
    }
</style>

<div class="container">

    <div class="col-12">

        <div class="row">

            <section class="col-12">

                <div class="bg-light p-4 mt-2">

                    @include('gestao.grades-aula._create')
                    @include('gestao.grades-aula._edit')

                    <div id="calendar">
                        {!! $calendar->calendar() !!}
                    </div>
                </div>

            </section>

        </div>

    </div>

</div>

