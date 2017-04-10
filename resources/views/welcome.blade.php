@extends('layouts.app')

@section('content')
    <div class="container-fluid ">
        <div class="row banner">
            <img src="{{ asset('images/banner.jpg') }}"/>
        </div>
    </div>

    <div class="container">
        <div class="row flex">
            <div class="col-md-4">
                <div class="panel panel-primary">
                    <div class="panel-heading">Heading 1</div>
                    <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                        Nemo igitur esse beatus potest. Quem Tiberina descensio festo illo die tanto gaudio affecit,
                        quanto L. Sed ego in hoc resisto; Duo Reges: constructio interrete. Itaque primos congressus
                        copulationesque et consuetudinum instituendarum voluntates fieri propter voluptatem; Minime
                        vero, inquit ille, consentit.
                        Expressa vero in iis aetatibus, quae iam confirmatae sunt.
                    </div>
                    <div class="panel-footer">Footer 1</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-primary">
                    <div class="panel-heading">Heading 2</div>
                    <div class="panel-body">De vacuitate doloris eadem sententia erit. Quid dubitas igitur mutare
                        principia naturae? Quis enim potest ea,
                        quae probabilia videantur ei, non probare? Cur post Tarentum ad Archytam? Quod autem principium
                        officii quaerunt, melius quam Pyrrho; At ego quem
                        huic anteponam non audeo dicere; Haec mihi videtur delicatior, ut ita dicam,
                        molliorque ratio, quam virtutis vis gravitasque postulat. Non quam nostram quidem, inquit
                        Pomponius iocans; Nec enim, dum metuit, iustus est, et certe, si metuere destiterit, non erit;
                        Quia dolori non voluptas contraria est, sed doloris privatio.
                    </div>
                    <div class="panel-footer">Footer 2</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-primary">
                    <div class="panel-heading">Heading 3</div>
                    <div class="panel-body">Bona autem corporis huic sunt, quod posterius posui, similiora. Mene ergo et
                        Triarium dignos existimas, apud quos turpiter loquare? Nemo igitur esse beatus potest. Sed id ne
                        cogitari
                        quidem potest quale sit, ut non repugnet ipsum sibi
                    </div>
                    <div class="panel-footer">Footer 3</div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <hr/>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="jumbotron">
                    <h1>Hello, world!</h1>
                    <p>Huius, Lyco, oratione locuples, rebus ipsis ielunior. Inquit, dasne adolescenti veniam? Sic
                        consequentibus
                        vestris sublatis prima tolluntur. Piso, familiaris noster, et alia multa et hoc loco Stoicos
                        irridebat:
                        Quid enim? Primum in nostrane potestate est, quid meminerimus? Mihi vero, inquit, placet agi
                        subtilius et,
                        ut ipse dixisti, pressius. Fortasse id optimum, sed ubi illud: Plus semper voluptatis? Itaque ab
                        his ordiamur.
                        Non quaeritur autem quid naturae tuae consentaneum sit, sed quid disciplinae. Sin aliud quid
                        voles, postea. </p>
                    <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a></p>
                </div>
            </div>
        </div>
    </div>
@endsection

