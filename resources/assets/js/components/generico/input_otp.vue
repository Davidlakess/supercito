<template>
  <div class="container">
      <b-alert :show = "showalert"  variant="danger"  >
        <div style="display: inline-flex;vertical-align: middle;"><v-icon color="error" style="margin-right: 14px;">warning</v-icon>{{error}}</div>
      </b-alert>
      <div style="text-align: center;">
        <span>
          Ingresa aqui el codigo de 6 digitos.
        </span>
      </div>
    <div style="display: inline-flex;">
      <template v-for="(item, key) in quantity(cant)">
      <v-text-field
      @keyup="digitvalidate(item.ref, $event, item.index)"
      :ref="item.ref"
      class ="otp-input"
      type="number"
      @focus="$event.target.select()"
      maxlength=1
      solo
    ></v-text-field>
      </template>
    </div>
</div>
</template>
<script>
export default {
  mounted () {
    this.$refs.digit1[0].$refs.input.focus()
  },
  data () {
    return {
      cant: 6,
      showalert: false,
      error: 'codigo incorrecto',
      config: {
        color: 'success',
        timeout: 6000,
        y: 'bottom',
        text: '¡Producto Agregado!'
      }
    }
  },
  methods: {
    verificarCodigo (codex, aux) {
      // poner axios
      var code = '123456'
      if (codex === code) {
        this.$refs['digit' + (aux)][0].$refs.input.blur()
        this.config.text = 'Codigo Correcto'
        this.config.color = 'success'
        window.eventBus.$emit('toast', this.config)
        this.showalert = false
      } else {
        this.showalert = true
        this.$refs['digit' + (aux)][0].$refs.input.blur()
      }
    },
    quantity (cantidad) {
      var datos = []
      var ax = 1
      for (var i = 0; i < cantidad; i++) {
        datos[i] = {ref: 'digit' + ax, index: ax}
        ax++
      }
      return datos
    },
    accion (ref, key, event) {
      var aux = parseInt(key)
      var str = this.$refs[ref][0].$refs.input.value
      this.$refs[ref][0].$refs.input.value = str.replace(/[^0-9\\.]+/g, '')

      if (this.$refs[ref][0].$refs.input.value !== '') {
        if (key < this.cant) {
          this.$refs['digit' + (aux + 1)][0].$refs.input.focus()
        } else {
          var codex = ''
          for (var i = 1; i <= this.cant; i++) {
            codex += this.$refs['digit' + i][0].$refs.input.value
          }
          this.verificarCodigo(codex, aux)
        }
      } else if (this.$refs[ref][0].$refs.input.value === '') {
        if (key > 1) {
          this.$refs['digit' + (aux - 1)][0].$refs.input.focus()
          this.$refs['digit' + (aux - 1)][0].$refs.input.select()
        }
      }
    },
    digitvalidate (ref, event, key) {
      var ax = parseInt(key)
      switch (event.code) {
        case 'ArrowRight':
          if (ax < this.cant) {
            this.$refs['digit' + (ax + 1)][0].$refs.input.focus()
          }
          break
        case 'ArrowLeft':
          if (ax > 1) {
            this.$refs['digit' + (ax - 1)][0].$refs.input.focus()
          }
          break
        default:
          this.accion(ref, key, event)
      }
    }
  }
}
</script>
<style>
  .otp-input .v-input__slot{
    border: solid 2px #b1aff7;
  }
  .otp-input{
    width: 13%;
    margin-right: 5px !important;
    font-size: 23px;
  }
  .otp-input input{
    display:inline-block;
    height:50px;
    text-align:center;
  }
  .overlay-otp {
    text-align: center;
    height: 50px;
    width: 70%;
    margin-left: 12%;
    background: #2b262678;
    position: absolute;
    border-radius: 9px;
    padding-top: 8px;
  }
  input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}
</style>