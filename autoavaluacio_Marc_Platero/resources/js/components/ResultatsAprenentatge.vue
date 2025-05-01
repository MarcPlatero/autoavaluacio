<template>
    <div v-if="resultadosDeAprendizaje.message">
        <div class="alert alert-danger col-sm-12 mb-3">
            El modulo no tiene resultados de aprendizaje.
        </div>
    </div>
    <div v-else>
        <p v-if="tipoUsuario===2" class="h1 text-center">
            Autoevaluación {{codigoModulo}} {{nombreAlumno}} {{apellidosAlumno}}
        </p>
        <p v-else class="h1 text-center">
            Autoevaluación {{codigoModulo}}
        </p>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col" class="text-center border border-secondary">
                        Grandes preguntas
                    </th>
                    <th class="border border-secondary"></th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="resultadoDeAprendizaje in resultadosDeAprendizaje">
                    <td class="td border border-secondary">
                        <div>
                            {{resultadoDeAprendizaje.descripcio}}
                        </div>
                    </td>
                    <td class="border border-secondary">
                        <table class="table table-striped">
                            <thead>
                                <tr> 
                                    <th scope="col" class="td text-center border border-secondary">
                                        Más preguntas
                                    </th>
                                    <th scope="col" class="td text-center border border-secondary">
                                        "Nivel 1: Conocer y saber replicar. Saber recibir ayuda. Siguiendo un modelo pautado puedo_______"
                                    </th>
                                    <th scope="col" class="td text-center border border-secondary">
                                        "Nivel 2: Saber hacer siguiendo instrucciones. Saber ayudar entre iguales. Siguiendo instrucciones genéricas puedo_______"
                                    </th>
                                    <th scope="col" class="td text-center border border-secondary">
                                        "Nivel 3: Saber resolver y/o crear de forma autónoma. Aportar sugerencias de mejora. Investingante puedo______"
                                    </th>
                                    <th scope="col" class="td text-center border border-secondary">
                                        Autoevaluación
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <template v-for="criteriosDeEvaluacionUno in criteriosDeEvaluacionCero">
                                    <template v-for="criterioDeEvaluacion in criteriosDeEvaluacionUno">
                                        <tr v-if="criterioDeEvaluacion.resultats_aprenentatge_id===resultadoDeAprendizaje.id" class="border border-secondary">
                                            <td class="td border border-secondary">
                                                {{criterioDeEvaluacion.descripcio}}
                                            </td>
                                            <template v-for="rubricasUno in rubricasCero">
                                                <template v-for="rubrica in rubricasUno">
                                                    <td v-if="rubrica.criteris_avaluacio_id===criterioDeEvaluacion.id" class="td border border-secondary">
                                                        {{rubrica.descripcio}}
                                                    </td>
                                                </template>
                                            </template>
                                            <td class="td border border-secondary">
                                                <template v-for="nota in notasCero">
                                                    <template v-if="nota.idCriteriosEvaluacion===criterioDeEvaluacion.id" class="td border border-secondary">
                                                        <p v-if="tipoUsuario===2">{{nota.nota}}</p>
                                                        <select v-else class="form-select" aria-label="Default select example" @click="cambiarNota(criterioDeEvaluacion.id,$event.target.value)">
                                                            <option value="0" :selected="nota.nota === 0">0</option>
                                                            <option value="1" :selected="nota.nota === 1">1</option>
                                                            <option value="2" :selected="nota.nota === 2">2</option>
                                                            <option value="3" :selected="nota.nota === 3">3</option>
                                                        </select>
                                                    </template>
                                                </template>
                                            </td>
                                        </tr>
                                    </template>
                                </template>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>


<script>
    export default {
        data() {
            return {
                tipoUsuario:0,
                codigoModulo:'',
                nombreAlumno:'',
                apellidosAlumno:'',
                parametrosConsulta:'',
                idModulo:0,
                resultadosDeAprendizaje:[],
                idsResultadosDeAprendizaje:"",
                criteriosDeEvaluacionCero:[],
                idsCriteriosDeEvaluacion:"",
                rubricasCero:[],
                idUsuario:0,
                notasCero:[],
                messageError:""
            };
        },
        methods: {
            obtenerTipoDelUsuario()
            {
                const me=this
                axios
                    .get("recuperarTipusUsuari")
                    .then(response=>{
                        me.tipoUsuario=response.data.tipus
                        me.obtenerEncabezado()
                    })
                    .catch(error=>{

                    })
            },
            obtenerEncabezado()
            {
                this.parametrosConsulta=window.location.search;
                this.codigoModulo=this.parametrosConsulta.split("=")[2];
                this.codigoModulo=this.codigoModulo.split("&")[0];

                if(this.tipoUsuario===2)
                {
                    this.parametrosConsulta=window.location.search;
                    this.nombreAlumno=this.parametrosConsulta.split("=")[4];
                    this.nombreAlumno=this.nombreAlumno.split("&")[0];
                    this.nombreAlumno=this.nombreAlumno.replace(/%20/g, ' ');
                    this.apellidosAlumno=this.parametrosConsulta.split("=")[5];
                    this.apellidosAlumno=this.apellidosAlumno.split("&")[0];
                    this.apellidosAlumno=this.apellidosAlumno.replace(/%20/g, ' ');
                }
                this.obtenerIdModulo()
            },
            obtenerIdModulo()
            {
                this.parametrosConsulta=window.location.search;
                this.idModulo=this.parametrosConsulta.split("=")[1];
                this.idModulo=this.idModulo.split("&")[0];
                this.obtenerResultadosDeAprendizaje()
            },
            obtenerResultadosDeAprendizaje()
            {
                const me=this
                axios
                    .get("api/obtenirResultatsAprenentatge/"+me.idModulo)
                    .then(response=>{
                        me.resultadosDeAprendizaje=response.data
                        for (let i = 0; i < me.resultadosDeAprendizaje.length; i++){
                            // Agregar el ID del resultado de aprendizaje
                            me.idsResultadosDeAprendizaje += me.resultadosDeAprendizaje[i].id;
                            
                            // Si no es el último elemento, agregar una coma
                            if (i < me.resultadosDeAprendizaje.length - 1) {
                                me.idsResultadosDeAprendizaje += ",";
                            }
                        }
                        me.obtenerCriteriosDeEvaluacion()
                    })
                    .catch(error=>{

                    })
            },
            obtenerCriteriosDeEvaluacion()
            {
                const me=this
                axios
                    .get("api/obtenirCriterisAvaluacio/"+this.idsResultadosDeAprendizaje)
                    .then(response=>{
                        me.criteriosDeEvaluacionCero=response.data
                        for (let i = 0; i < me.criteriosDeEvaluacionCero.length; i++) {
                            for (let j = 0; j < me.criteriosDeEvaluacionCero[i].length; j++) {
                                // Agregar el ID del criterio de evaluación
                                me.idsCriteriosDeEvaluacion += me.criteriosDeEvaluacionCero[i][j].id;
                                
                                // Si no es el último elemento del array interno, agregar una coma
                                if (j < me.criteriosDeEvaluacionCero[i].length - 1) {
                                    me.idsCriteriosDeEvaluacion += ",";
                                }
                            }

                            // Si no es el último array interno, agregar una coma
                            if (i < me.criteriosDeEvaluacionCero.length - 1) {
                                me.idsCriteriosDeEvaluacion += ",";
                            }
                        }
                        me.obtenerRubricas()
                    })
                    .catch(error=>{

                    })
            },
            obtenerRubricas()
            {
                const me=this
                axios
                    .get("api/obtenirRubriques/"+me.idsCriteriosDeEvaluacion)
                    .then(response=>{
                        me.rubricasCero=response.data
                        me.obtenerIdDelUsuario()
                    })
                    .catch(error=>{

                    })
            },
            obtenerIdDelUsuario()
            {
                this.parametrosConsulta=window.location.search;
                this.idUsuario=this.parametrosConsulta.split("=")[3];
                this.obtenerNotas()
            },
            obtenerNotas()
            {
                const me=this
                axios
                    .get("api/obtenirNotes/"+me.idUsuario+"/"+me.idsCriteriosDeEvaluacion)
                    .then(response=>{
                        me.notasCero=response.data
                    })
                    .catch(error=>{

                    })
                    console.log(me.notasCero)
            },
            cambiarNota(idCriteriosEvaluacion,nota)
            {
                const me=this
                axios
                    .put("api/canviarNota/"+me.idUsuario+"/"+idCriteriosEvaluacion+"/"+nota)
                    .then(response=>{
                    })
                    .catch(error=>{
                        this.isError=true
                        console.log(error)
                        me.messageError=error.response.data.error
                    })
            }
        },
        created(){
            this.obtenerTipoDelUsuario()
        }
    }
</script>


<style>
    .td{
        vertical-align: middle;
        text-align: center;
    }
</style>