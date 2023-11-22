<template>
	<div :class="{'has-file':showRemovedBtn}" class="c-file-input js-file-input">
      <div class="c-file-input__indicator">
      	     <span class="c-file-input__indicator__icon c-icon c-icon--attach">
      	     	<i class="fa fa-paperclip" aria-hidden="true"></i>

      	     </span>
      </div>
      <label class="c-file-input__label js-file-input__label" for="inputfile">
        <span>{{ theFileName }}</span>
        <input
          id="inputfile"
          accept="image/*"
          multiple
          type="file" @change="fileChangeHandler"
          v-on:input="$emit('input', $event.target.files[0])"
          name="files[]" class="c-file-input__field js-file-input__field">
      </label>
      <div class="c-file-input__remove js-file-input__remove">
        <span class="c-file-input__remove__icon c-icon c-icon--remove-circle">
        	        <i class="fa fa-minus-circle text-red" @click.stop="$emit('input', clearFileHandler())" ></i>
        </span>
      </div>
    </div>
</template>
<script>
export default {
	model: {
	    event:[ 'input']

  	},
	props: {
	    labelPlaceholder: {
	      type: String,
	      default: 'Selecciona un Archivo',
	    },
	    file:[]
  	},
   	data() {
	      return {
	      value: '',
	      files:[],
	      showRemovedBtn: false,
	      }
	  },
	    computed: {
	    	theFileName() {
		      if ((this.files.length > 0) && 'name' in this.files[0]) {
		        return this.files[0].name;
		      }
		      return this.labelPlaceholder;
	    	}
	  	},
	    methods: {
		fileChangeHandler(e) {
		  this.files = Array.from(e.target.files);
		  this.showRemovedBtn = true;
		 
		},
		clearFileHandler() {
		  const el = this.$el.querySelector('.js-file-input__field');
		  const wrapper = document.createElement('form');
		  this.wrapInputAndReset(el, wrapper);
		},
		wrapInputAndReset(el, wrapper) {
		  // wrap input with form tag
		  el.parentNode.insertBefore(wrapper, el);
		  wrapper.appendChild(el);

		  // reset input with form.reset()
		  wrapper.reset();

		  // place childNodes in document fragment
		  const docFrag = document.createDocumentFragment();
		  while (wrapper.firstChild) {
		    const child = wrapper.removeChild(wrapper.firstChild);
		    docFrag.appendChild(child);
		  }
		  // replace wrapper with document fragment
		  wrapper.parentNode.replaceChild(docFrag, wrapper);

		  this.files = [];
		  this.showRemovedBtn = false;
    	},
	}
}
</script>
