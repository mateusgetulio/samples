class PetsController < ApplicationController
  # Prevent the layout from being inherited for lista_pets and pesquisa_pets
  layout false, only: [:lista_pets, :pesquisa_pets]

  # Filter
  @@id_familia_filtro = '-1'

  # Render the index page
  def index
    @@id_familia_filtro = '-1'
    @pets = Pet.all
    render 'main/ficha'
  end

  # List the pets
  def lista_pets()
    @@id_familia_filtro = params["id_familia"]
    if @@id_familia_filtro == '-1'
      @pets = Pet.all
    else
      @pets = Pet.search('id_familia', @@id_familia_filtro)
    end
    
    render params["template"]
  end

  # Search method
  def pesquisa_pets()
    # Get the term that was searched
    @pesquisa = params["pesquisa"]
    # If the search isn't empty then the filter is applied
    if @pesquisa == ''
      if @@id_familia_filtro == '-1'
        # List all pets
        @pets = Pet.all
      else
        # Perform the search
        @pets = Pet.search('id_familia', @@id_familia_filtro)
      end

    else
      if @@id_familia_filtro == '-1'
        # Perform the search based on the breed
        @pets = Pet.search('raca', @pesquisa)
      else
        # Perform the filter based on the breed
        @pets = Pet.search('id_familia', @@id_familia_filtro).search('raca', @pesquisa)
      end
      
    end
    
    render params["template"] 
  end

end