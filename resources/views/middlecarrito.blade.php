@extends('layouts.app2')
@section('content')
    <b-container>
    <div class="card card-login mx-auto text-center">
            
      <div class="card-body">
        <div>
          <b-row align-h="center">
            <b-col cols="12" >
              <span style="font-size: 24px; font-weight: 600;">
                  ¡Hola! Para agregar a tu carrito,
              </span>
           </b-col>
           <b-col cols="12" style="margin-bottom: 10px;">
              <span style="font-size: 24px;font-weight: 600;">
                  ingresa a tu cuenta
              </span>
           </b-col>

           <b-col cols="10" >
         <b-button variant="primary"  href="{{ route('register') }}" class="btn-mv"  block >
                 Soy nuevo
          </b-button>
           </b-col>
           <b-col cols="10" >
              <b-button class="btn-mv-o" href="{{ route('login') }}" variant="trasparent"  block >
                Ya tengo cuenta
              </b-button>
           </b-col>
          </b-row>
        </div>
      </div>
    </div>
  </b-container>
@endsection
<style>
#foot1 {
    position: absolute !important;
}

        .card-login {
            margin-top: 3%;
            padding: 18px;
            max-width: 26.5rem;

        }
        .card-header {
            color: #fff;
            /*background: #ff0000;*/
            font-family: sans-serif;
            font-size: 20px;
            font-weight: 600 !important;
            margin-top: 10px;
            border-bottom: 0;
        }

        .input-group-prepend span{
            width: 50px;
            background-color: #ff0000;
            color: #fff;
            border:0 !important;
        }

        input:focus{
            outline: 0 0 0 0  !important;
            box-shadow: 0 0 0 0 !important;
        }

        .login_btn{
            width: 130px;
        }

        .login_btn:hover{
            color: #fff;
            background-color: #ff0000;
        }

        .btn-outline-danger {
            color: #fff;
            font-size: 18px;
            background-color: #28a745;
            background-image: none;
            border-color: #28a745;
        }

        .form-control {
            display: block;
            width: 100%;
            height: calc(2.25rem + 2px);
            padding: 0.375rem 0.75rem;
            font-size: 1.2rem;
            line-height: 1.6;
            color: #28a745;
            background-color: transparent;
            background-clip: padding-box;
            border: 1px solid #28a745;
            border-radius: 0;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .input-group-text {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-align: center;
            align-items: center;
            padding: 0.375rem 0.75rem;
            margin-bottom: 0;
            font-size: 1.5rem;
            font-weight: 700;
            line-height: 1.6;
            color: #495057;
            text-align: center;
            white-space: nowrap;
            background-color: #e9ecef;
            border: 1px solid #ced4da;
            border-radius: 0;
        }
.btn-mv{
  font-size: 17px;
  font-weight: 600;
  line-height: 48px;
  padding: 0;
  border-radius: 8px;
}
.btn-mv-o{
  font-size: 17px;
  font-weight: 600;
  padding: 10px;
  color: blue;
  margin: .5rem 0 0;
 
}
.btn-mv-o:hover{
  background-color:#ecf3fc;
  color: blue;
  border-radius: 8px;
}
</style>