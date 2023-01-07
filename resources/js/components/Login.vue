<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Login</div>

                    <div class="card-body">
                        <div>
                            <label>User Name:</label>
                            <input type="text"/>
                        </div>
                        <div>
                            <label>Password</label>
                            <input type="password"/>
                        </div>                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
