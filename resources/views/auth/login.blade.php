@extends('layouts.app2')

@section('content')
<b-container fluid>
  <b-row align-h="center">
    <b-col cols="12" md="6">
      <b-card title="Iniciar sesión" class="my-3" >
        @if ($errors->any())
            <b-alert show variant="danger">
              <ul>
                <li>{{$errors->first()}}</li>
              </ul>
            </b-alert>
          
        @endif
        
         @if (isset($csrf_error))
          <b-alert show variant="danger">
            <ul>
              <li>{{$csrf_error}}</li>
            </ul>
          </b-alert>
        @endif          
       <b-form method="POST" action="{{ route('login') }}">
          {{ csrf_field() }}
          <b-form-group label="Correo Electronico" label-for="email">
            <b-form-input type="email"
              name="email" required
              autofocus value="{{ old('email') }}" 
              placeholder="example@gmail.com">
              </b-form-input>
          </b-form-group>
          <b-form-group label="Contraseña" label-for="password">
            <b-form-input type="password"
              name="password" required
              value="{{ old('password') }}" >
            </b-form-input>
          </b-form-group>
            <!-- <div style="margin-bottom: 5px;">Iniciar con:</div> -->
           <b-form-group>
              <b-form-checkbox name="remember" {{old('remember') ? 'checked="true"' : ''}}>
              Recordar sesion
            </b-form-checkbox>
          </b-form-group>
          <b-form-group>
    
           <b-button type="submit" variant="primary">
                    Ingresar
            </b-button>
         </b-form-group>
        </b-form >

         <b-row align-h="center">
              <b-col cols="12" class="text-md-right text-sm-center">
                <b-button variant="link" href="{{ route('password.request') }}">
                        Olvidaste tu Contraseña?
                </b-button>
          </b-col>
          </b-row>
      </b-card>
    </b-col>  
  </b-row>


</b-container>
<script type="text/javascript">
  document.title ='Iniciar Sesion';
</script>
@endsection
