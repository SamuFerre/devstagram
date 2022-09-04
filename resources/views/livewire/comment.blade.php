<div>
    <div class="mb-5">
        <label for="comentario" class="mb-2 block uppercase text-gray-500 font-bold">
            Comment
        </label>
        <textarea 
            id="comentario"
            name="comentario"
            placeholder="Add a comment"
            class="border p-3 w-full rounded-lg @error('descripcion') border-red-500 @enderror"
        ></textarea>

        @error('comentario')
            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
        @enderror
    </div>

    <input 
    type="submit"
    value="Comment"
    class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg"/>
</div>
