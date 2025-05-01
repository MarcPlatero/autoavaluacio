<template>
  <div>
      <p class="h5 text-center mb-3">
          Alumnos inscritos a {{codigoModulo}}
      </p>
      <template v-for="alumno in alumnos">
          <div class="alert alert-secondary col-sm-12 mb-3 modulo" @click="mRDAiCDA(alumno.id,alumno.nombre,alumno.apellidos)">
              {{alumno.id}} - {{alumno.nombre}} {{alumno.apellidos}}
          </div>
      </template>
  </div>
</template>


<script>
export default {
  data(){
          return {
              parametrosConsulta:'',
              idModulo:0,
              codigoModulo:'',
              alumnos:[]
          }
      },
      methods: {
          obtenerIdModulo()
          {
              this.parametrosConsulta=window.location.search;
              this.idModulo=this.parametrosConsulta.split("=")[1];
              this.idModulo=this.idModulo.split("&")[0];
              this.obtenerCodigoModulo()
          },
          obtenerCodigoModulo()
          {
              this.parametrosConsulta=window.location.search;
              this.codigoModulo=this.parametrosConsulta.split("=")[2];
              this.obtenerAlumnosInscritosAlModulo()
          },
          obtenerAlumnosInscritosAlModulo(){
              const me=this
              axios
                  .get("api/mostrarAlumnesInscritsAlModul/"+me.idModulo)
                  .then(response=>{
                      me.alumnos=response.data
                  })
                  .catch(error=>{

                  })
          },
          mRDAiCDA(idUsuario,nombreAlumno,apellidosAlumno)
          {
              window.location.href = '/DAW/M07/autoavaluacio_Marc_Platero/public/resultatsAprenentatge?idModulo='+this.idModulo+"&codigoModulo="+this.codigoModulo+"&idAlumno="+idUsuario+"&nombreAlumno="+nombreAlumno+"&apellidosAlumno="+apellidosAlumno;
          }
      },
      created(){
          this.obtenerIdModulo()
      },
}
</script>


<style>
  
</style>