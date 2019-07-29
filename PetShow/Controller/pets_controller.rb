class PetsController < ApplicationController
  layout false, only: [:lista_pets, :pesquisa_pets]

  
  @@id_familia_filtro = '-1'

  def index
    @@id_familia_filtro = '-1'
    @pets = Pet.all
    render 'main/ficha'
  end

  def lista_pets()
    @@id_familia_filtro = params["id_familia"]
    if @@id_familia_filtro == '-1'
      @pets = Pet.all
    else
      @pets = Pet.search('id_familia', @@id_familia_filtro)
    end
    
    render params["template"]
  end


  def pesquisa_pets()
    @pesquisa = params["pesquisa"]
    if @pesquisa == ''
      if @@id_familia_filtro == '-1'
        @pets = Pet.all
      else
        @pets = Pet.search('id_familia', @@id_familia_filtro)
      end

    else
      if @@id_familia_filtro == '-1'
        @pets = Pet.search('raca', @pesquisa)
      else
        @pets = Pet.search('id_familia', @@id_familia_filtro).search('raca', @pesquisa)
      end
      
    end
    
    render params["template"] 
  end

end