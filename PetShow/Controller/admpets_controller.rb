class AdmpetsController < ApplicationController
  layout "admin/default"
  before_action :require_user
  before_action :set_pet, only: [:edit, :update, :show, :destroy]
   
  def index
    @pets = Pet.all
    render 'admin/pets/index'
  end

  def new
    @pet = Pet.new
    render 'admin/pets/new'
  end
  
  def edit
    render 'admin/pets/edit'
  end
  
  def create
    @pet = Pet.new(pet_params)
    if @pet.save
      flash[:success] = "Pet inserido com sucesso"
      redirect_to pet_path(@pet)
    else
      render 'admin/pets/new'
    end
  end
  
  def update
    if @pet.update(pet_params)
      flash[:success] = "Pet foi atualizado com sucesso"
      redirect_to pet_path(@pet)
    else
      render 'admin/pets/edit'
    end
  end
  
  def show
    render 'admin/pets/show'
  end
  
  def destroy
    @pet.destroy
    flash[:danger] = "Pet excluído!"
    redirect_to pets_path
  end
  
  private
  
  def set_pet
    @pet = Pet.find(params[:id])
  end
  
  def pet_params
    params.require(:pet).permit(:id_familia, :raca, :resumo, :origem, :caracteristicas, :temperamento, :foto)
  end

  
end
