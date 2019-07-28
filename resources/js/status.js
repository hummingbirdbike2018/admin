new Vue({
	el: '#status',
	data: {
		show: false
	},
	methods: {
		handler: function (event) {
			if(event.target.value === 3){
				 this.show = true
			}else{
				this.show = false
		 }
		}
	}
})
