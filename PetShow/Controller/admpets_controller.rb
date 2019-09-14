class AdmpetsController < ApplicationController
  # Apply a different layout
  layout "admin/default"
  # Set a method to be executed before any action
  before_action :require_user
  # Set a method to be executed before some specific actions
  before_action :set_pet, only: [:edit, :update, :show, :destroy]
  
  # Render index 
  def index
    @pets = Pet.all
    render 'admin/pets/index'
  end

  # Render the insert page
  def new
    @pet = Pet.new
    render 'admin/pets/new'
  end
  
  # Render the edit page
  def edit
    render 'admin/pets/edit'
  end
  
  # Save the pet
  def create
    @pet = Pet.new(pet_params)
    if @pet.save
      flash[:success] = "Pet inserido com sucesso"
      redirect_to pet_path(@pet)
    else
      render 'admin/pets/new'
    end
  end
  
  # Update the pet
  def update
    if @pet.update(pet_params)
      flash[:success] = "Pet foi atualizado com sucesso"
      redirect_to pet_path(@pet)
    else
      render 'admin/pets/edit'
    end
  end
  
  # Render the details page
  def show
    render 'admin/pets/show'
  end
  
  # Delete the pet
  def destroy
    @pet.destroy
    flash[:danger] = "Pet excluído!"
    redirect_to pets_path
  end
  
  # Find a specific  pet
  private
  def set_pet
    @pet = Pet.find(params[:id])
  end
  
  # Require some params before saving the pet
  def pet_params
    params.require(:pet).permit(:id_familia, :raca, :resumo, :origem, :caracteristicas, :temperamento, :foto)
  end

  
end
