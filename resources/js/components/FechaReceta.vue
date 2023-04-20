<template>
    <span v-text="formatearfecha"></span>
</template>
<script>
    export default {
        props: ['fecha'],
        /* mounted() {
            console.log('La fecha es:' this.fecha);
        } */
        computed: {
            formatearfecha() {
                //aca utilizaremos el codigo de moment
                return moment(this.fecha).locale('es').format('DD [de] MMMM [del] YYYYY')
            }
        }
    }
</script>

