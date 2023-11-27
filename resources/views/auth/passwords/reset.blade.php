@extends('layouts.app2')

@section('content')
<b-container fluid style="height: 100%">
  <b-row align-h="center">
    <b-col cols="12" md="6" style="margin-top: 7%;margin-left: 1px;margin-right: 10px;">
<b-card title="Restablecer Contraseña" class="my-3" >
    <b-form method="POST" action="{{ route('password.request') }}">
        {{ csrf_field() }}
        <input type="hidden" name="token" value="{{ $token }}">
            <b-form-group
      label="Email"
      label-for="email">
          
          <b-form-input    id="email" type="email" readonly name="email" value="{{ $email or old('email') }}" required>
          </b-form-input>

          @if ($errors->has('email'))
              <b-alert show variant="danger">
                  <strong>{{ $errors->first('email') }}</strong>
              </b-alert>
          @endif
        </b-form-group>
        
          <b-form-group
      label="Nueva Contraseña"
      label-for="password">
          <b-form-input  
            autofocus 
            id="password" type="password" name="password" required
            placeholder="">
        </b-form-input>
            @if ($errors->has('password'))
                <b-alert show variant="danger">
                    {{ $errors->first('password') }}
                </b-alert>
            @endif
      </b-form-group>

          <b-form-group
      label="Confirmar Contraseña"
      label-for="password-confirm">
          

        <b-form-input  
          id="password-confirm" 
          type="password"
          name="password_confirmation" 
          required>
        </b-form-input>

            @if ($errors->has('password_confirmation'))
                <span class="help-block">
                    <strong></strong>
                </span>
                <b-alert show variant="danger">{{ $errors->first('password_confirmation') }}</b-alert>
            @endif
        </b-form-group>
        <b-form-group style="text-align: end;">
            <button type="submit" class="btn btn-primary">
                Cambiar clave
            </button>
        </b-form-group>
    </b-form>
  </b-card>
    </b-col>  
  </b-row> 
</b-container>
@endsection
<script type="text/javascript">
     document.title ='Nueva Contraseña';
</script>