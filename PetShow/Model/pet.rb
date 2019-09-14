class Pet < ApplicationRecord
	# Validation
  validates :raca, presence: true, uniqueness: { case_sensitive: false }, length: { minimum: 3, maximum: 250 }
  validates :resumo, presence: true, length: { minimum: 3, maximum: 4000 }
  validates :origem, presence: true, length: { minimum: 3, maximum: 4000 }
  validates :temperamento, presence: true, length: { minimum: 3, maximum: 4000 }
  validates :caracteristicas, presence: true, length: { minimum: 3, maximum: 4000 }
  
  # Image uploader
  mount_uploader :foto, ImageUploader
  default_scope { order(raca: :asc) }

  # Search
  def self.search(campo, valor)
    if campo
	  where('cast(' + campo +' as varchar)'  + ' LIKE ?', "%#{valor}%")
    else
    
    end
  end  

end