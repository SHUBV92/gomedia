<template>
    <div>
<h2>Books</h2>
<!-- <form>
    <div class="form-group">

    </div> -->
<nav aria-label="Page navigation example">
  <ul class="pagination">
    <li v-bind:class="[{disabled: !pagination.prev_page_url}]"
    class="page-item"><a class="page-link" href="#"
    @click="fetchBooks(pagination.prev_page_url)">Previous</a></li>
    
      <li class="page-item disabled"><a class="page-link text-dark" href="#">Page {{pagination.current_page}} of {{pagination.last_page}}</a></li>

    <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item"
    @click="fetchBooks(pagination.next_page_url)" ><a class="page-link" href="#">Next</a></li>
  </ul>
</nav>
    <div class="card card-body" v-for="book in books" v-bind:key="book.id">
    <h3> 
        {{book.title}}
    </h3>
        <p>{{book.author}}</p>
        <hr /> 
        <button @click="deleteBook(book.id)" class="btn btn-danger">Delete</button>
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
    },

    methods: {
        fetchBooks(page_url){
            let vm = this
            page_url = page_url || 'http://localhost:8000/api/books'
            fetch(page_url)
            .then(res => res.json())
            .then(res => {
                console.log(res.data)
                this.books = res.data;
                vm.makePagination(res.meta, res.links)
            })
        }, 
        makePagination(meta, links){
            let pagination = { 
                current_page: meta.current_page,
                last_page: meta.last_page,
                next_page_url: links.next,
                prev_page_url: links.prev
            }
            this.pagination = pagination
        },
        deleteBook(id){
            if(confirm('Are You Sure?')){
                fetch(`api/book/${id}`, {
                    method: 'delete'
                })
                .then(res => res.json())
                .then(data => {
                    alert("Book Removed")
                    this.fetchBooks();
                })
                .catch(err => console.log(err));
            }
        }
    }
};
</script>