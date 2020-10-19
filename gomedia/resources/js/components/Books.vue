<template>
    <div>
<h2>Books</h2>
    <div class="card card-body" v-for="book in books" v-bind:key="book.id">
    <h3> 
        Shubinder
        {{article.title}}
    </h3>
        <p>{{article.author}}</p>
    </div>
    </div>

</template>


<script>
export default {
    data(){
        return {
            books: [],
            book: {
            id: "",
            title: "",
            author: ""
            },
            book_id: "",
            pagination: {},
            edit: false
        }
    },
    created(){
        this.fetchBooks()
        console.log("it ran")
        console.log("books", books)
    },

    methods: {
        fetchBooks(){
            fetch('http://localhost:8000/api/books')
            .then(res => res.json())
            .then(res => {
                console.log(res.data)
                this.books = res.data;
            })
        }
    }
}
</script>