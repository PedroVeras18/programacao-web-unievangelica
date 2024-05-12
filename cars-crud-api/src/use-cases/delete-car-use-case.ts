import { CarsRepository } from '@/repositories/cars-repository'
import { ResourceNotFoundError } from './errors/resource-not-found-error'

interface DeleteCarUseCaseRequest {
  carId: string
}

export class DeleteCarUseCase {
  constructor(private carsRepository: CarsRepository) {}

  async execute({ carId }: DeleteCarUseCaseRequest) {
    const car = await this.carsRepository.findById(carId)

    if (!car) {
      throw new ResourceNotFoundError()
    }

    await this.carsRepository.delete(carId)
  }
}
